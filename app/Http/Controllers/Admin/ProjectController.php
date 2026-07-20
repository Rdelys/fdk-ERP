<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'guide_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('guide_pdf')) {
            $data['guide_pdf'] = $request->file('guide_pdf')->store('guides', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Projet créé avec succès');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'guide_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('guide_pdf')) {
            $data['guide_pdf'] = $request->file('guide_pdf')->store('guides', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Projet supprimé');
    }
}