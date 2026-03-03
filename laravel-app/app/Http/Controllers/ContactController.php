<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\SiteSetting;
use App\Mail\NewContactNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        try {
            $message = ContactMessage::create($validated);
        } catch (\Throwable $e) {
            Log::error('Contact form: failed to save message', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'message' => 'Could not save your message. Please try again.',
            ], 500);
        }

        // Notify foundation by email (non-blocking: log errors but don't fail request)
        try {
            $notifyAddress = SiteSetting::getValue(
                'ngo_email',
                config('mail.notify_to') ?: config('mail.from.address')
            );

            if (!empty($notifyAddress)) {
                Mail::to($notifyAddress)->send(new NewContactNotification($message));
            }
        } catch (\Throwable $e) {
            Log::error('Failed to send contact notification email: ' . $e->getMessage());
        }

        return response()->json(['message' => 'Thank you. Your message has been sent.'], 201);
    }
}
