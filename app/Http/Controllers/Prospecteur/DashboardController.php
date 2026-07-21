<?php

namespace App\Http\Controllers\Prospecteur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $stats = [
            'total_prospects' => $user->prospects()->count(),
            'total_vendus' => $user->prospects()->where('status', 'vendu')->count(),
            'total_non_vendus' => $user->prospects()->where('status', 'non_vendu')->count(),
            'total_en_cours' => $user->prospects()->where('status', 'en_cours')->count(),
            'prospects_ce_mois' => $user->prospects()->whereMonth('created_at', $today->month)->whereYear('created_at', $today->year)->count(),
            'ventes_ce_mois' => $user->prospects()->where('status', 'vendu')->whereMonth('updated_at', $today->month)->whereYear('updated_at', $today->year)->count(),
        ];

        // Taux de conversion
        $stats['taux_conversion'] = $stats['total_prospects'] > 0
            ? round(($stats['total_vendus'] / $stats['total_prospects']) * 100)
            : 0;

        // Evolution des prospects ajoutés sur 7 jours
        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $labels[] = $date->format('d/m');
            $data[] = $user->prospects()->whereDate('created_at', $date)->count();
        }

        // Répartition par projet (top 5)
        $parProjet = $user->prospects()
            ->selectRaw('project_id, count(*) as total, sum(case when status = "vendu" then 1 else 0 end) as ventes')
            ->with('project')
            ->groupBy('project_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        // Objectif personnel (statique pour l'instant, ajustable plus tard)
        $objectifVentes = 10;
        $progressionObjectif = $objectifVentes > 0 ? min(100, round(($stats['ventes_ce_mois'] / $objectifVentes) * 100)) : 0;

        return view('prospecteur.dashboard', compact(
            'stats', 'labels', 'data', 'parProjet', 'objectifVentes', 'progressionObjectif'
        ));
    }
}