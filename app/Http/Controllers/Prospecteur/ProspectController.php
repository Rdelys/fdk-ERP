<?php

namespace App\Http\Controllers\Prospecteur;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
{
    public function index()
    {
        $prospects = Auth::user()->prospects()->with('project')->latest()->paginate(10);
        return view('prospecteur.prospects.index', compact('prospects'));
    }

    public function create()
    {
        $projects = Project::where('is_active', true)->get();
        return view('prospecteur.prospects.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'notes' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'en_cours';

        Prospect::create($data);

        return redirect()->route('prospecteur.prospects.index')->with('success', 'Prospect ajouté');
    }

    public function edit(Prospect $prospect)
    {
        $this->authorizeProspect($prospect);
        $projects = Project::where('is_active', true)->get();
        return view('prospecteur.prospects.edit', compact('prospect', 'projects'));
    }

    public function update(Request $request, Prospect $prospect)
    {
        $this->authorizeProspect($prospect);

        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'notes' => 'nullable|string',
            'status' => 'required|in:en_cours,vendu,non_vendu',
        ]);

        $prospect->update($data);

        return redirect()->route('prospecteur.prospects.index')->with('success', 'Prospect mis à jour');
    }

    public function destroy(Prospect $prospect)
    {
        $this->authorizeProspect($prospect);
        $prospect->delete();
        return back()->with('success', 'Prospect supprimé');
    }

    private function authorizeProspect(Prospect $prospect)
    {
        if ($prospect->user_id !== Auth::id()) {
            abort(403);
        }
    }
}