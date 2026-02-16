<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteSetting;

class SettingsController extends Controller
{
    public function index()
    {
        return SiteSetting::pluck('value', 'key');
    }

    public function stats()
    {
        $projects = Project::all();
        $beneficiaries = $projects->sum('beneficiaries');
        $completed = $projects->where('status', 'completed')->count();
        $ongoing = $projects->where('status', 'ongoing')->count();

        return [
            'beneficiaries' => $beneficiaries,
            'communities_served' => (int) (SiteSetting::where('key', 'stat_communities')->value('value') ?? 0),
            'projects_completed' => $completed,
            'projects_ongoing' => $ongoing,
            'partners' => (int) (SiteSetting::where('key', 'stat_partners')->value('value') ?? 0),
        ];
    }
}
