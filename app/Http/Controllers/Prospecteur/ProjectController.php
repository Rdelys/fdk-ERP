<?php

namespace App\Http\Controllers\Prospecteur;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_active', true)->latest()->paginate(10);
        return view('prospecteur.projects.index', compact('projects'));
    }
}