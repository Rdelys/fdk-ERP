<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Prospect;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'total_prospecteurs' => User::where('role', 'prospecteur')->count(),
            'total_prospects' => Prospect::count(),
            'total_vendus' => Prospect::where('status', 'vendu')->count(),
            'total_en_cours' => Prospect::where('status', 'en_cours')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}