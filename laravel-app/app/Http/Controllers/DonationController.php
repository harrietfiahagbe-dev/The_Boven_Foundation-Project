<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Mail\ThankYouEmail;
use App\Mail\NewDonationNotification;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    public function index(): JsonResponse
    {
        $donations = Donation::orderBy('created_at', 'desc')->get();
        
        return response()->json($donations);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_method' => ['required', 'string', 'in:bank_transfer,mtn_mobile_money,telecel_cash,atmoney'],
            'transaction_reference' => ['nullable', 'string', 'max:255'],
            'payment_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        try {
            $donation = Donation::create($validated);

            // Send thank-you email to donor if email is provided
            if (!empty($validated['email'])) {
                try {
                    Mail::to($validated['email'])->send(new ThankYouEmail($donation));
                } catch (\Exception $e) {
                    // Log email error but don't fail the donation submission
                    Log::error('Failed to send thank-you email: ' . $e->getMessage());
                }
            }

            // Notify foundation about the new donation
            try {
                $notifyAddress = SiteSetting::getValue(
                    'ngo_email',
                    config('mail.notify_to') ?: config('mail.from.address')
                );

                if (!empty($notifyAddress)) {
                    Mail::to($notifyAddress)->send(new NewDonationNotification($donation));
                }
            } catch (\Throwable $e) {
                Log::error('Failed to send donation notification email: ' . $e->getMessage());
            }

            return response()->json([
                'message' => 'Thank you! Your donation confirmation has been received.',
                'donation' => $donation
            ], 201);
        } catch (\Exception $e) {
            Log::error('Failed to save donation: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
