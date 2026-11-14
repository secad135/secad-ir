<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $selectedTech = $request->query('tech');

        $query = Project::published()
            ->orderBy('sort_order')
            ->latest('created_at');

        if ($selectedTech) {
            $query->whereJsonContains('tech_stack', $selectedTech);
        }

        $projects = $query->paginate(12)->withQueryString();

        // لیست همه تکنولوژی‌های یکتا از پروژه‌های منتشرشده
        $allTechs = Project::published()
            ->pluck('tech_stack')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('projects.index', compact('projects', 'allTechs', 'selectedTech'));
    }

    public function show(Project $project)
    {
        abort_unless($project->is_published, 404);

        return view('projects.show', compact('project'));
    }
}
