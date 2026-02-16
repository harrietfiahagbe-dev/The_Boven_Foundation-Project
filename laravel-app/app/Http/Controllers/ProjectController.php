<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::orderBy('year', 'desc')->get();
    }

    public function show(Project $project)
    {
        return $project;
    }
}
