<?php

namespace App\Http\Controllers\Prospecteur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_prospects' => $user->prospects()->count(),
            'total_vendus' => $user->prospects()->where('status', 'vendu')->count(),
            'total_non_vendus' => $user->prospects()->where('status', 'non_vendu')->count(),
            'total_en_cours' => $user->prospects()->where('status', 'en_cours')->count(),
        ];

        return view('prospecteur.dashboard', compact('stats'));
    }
}