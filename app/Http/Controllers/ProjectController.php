<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::published()
            ->orderBy('sort_order')
            ->latest('created_at')
            ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        abort_unless($project->is_published, 404);

        return view('projects.show', compact('project'));
    }
}