<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;

class TeamController extends Controller
{
    public function index()
    {
        return TeamMember::orderBy('display_order')->get();
    }
}
