<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinanceObjectif;
use App\Models\FinanceTransaction;
use App\Models\Project;
use App\Models\Prospect;
use App\Models\User;
use Illuminate\Support\Carbon;

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

        $today = Carbon::today();

        $finance = [
            'jour' => $this->solde($today, $today),
            'mois' => $this->solde($today->copy()->startOfMonth(), $today->copy()->endOfMonth()),
            'annee' => $this->solde($today->copy()->startOfYear(), $today->copy()->endOfYear()),
        ];

        $objectifs = FinanceObjectif::pluck('montant', 'periode');

        // Statuts alertes : rouge (objectif non atteint <50%), bleu (entre 50 et 99%), vert (>=100%)
        $alertes = [];
        foreach (['jour', 'mois', 'annee'] as $periode) {
            $objectif = (float) ($objectifs[$periode] ?? 0);
            $solde = $finance[$periode]['solde'];
            $pourcentage = $objectif > 0 ? round(($solde / $objectif) * 100) : 0;

            $alertes[$periode] = [
                'pourcentage' => $pourcentage,
                'couleur' => $pourcentage >= 100 ? 'success' : ($pourcentage >= 50 ? 'info' : 'danger'),
            ];
        }

        // Evolution CA sur 7 derniers jours
        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i);
            $solde = $this->solde($date, $date)['solde'];
            $labels[] = $date->format('d/m');
            $data[] = $solde;
        }

        // Classement prospecteurs (top 5 par ventes)
        $classement = User::where('role', 'prospecteur')
            ->withCount([
                'prospects',
                'prospects as ventes_count' => fn ($q) => $q->where('status', 'vendu'),
            ])
            ->orderByDesc('ventes_count')
            ->take(5)
            ->get()
            ->map(function ($user) {
                $objectifIndividuel = 5; // objectif de ventes par prospecteur, ajustable plus tard
                $user->pourcentage = min(100, $user->ventes_count > 0 ? round(($user->ventes_count / $objectifIndividuel) * 100) : 0);
                return $user;
            });

        return view('admin.dashboard', compact('stats', 'finance', 'objectifs', 'alertes', 'labels', 'data', 'classement'));
    }

    private function solde($from, $to): array
    {
        $entree = FinanceTransaction::where('type', 'entree')
            ->whereBetween('date_transaction', [$from, $to])->sum('montant');

        $sortie = FinanceTransaction::where('type', 'sortie')
            ->whereBetween('date_transaction', [$from, $to])->sum('montant');

        return [
            'entree' => $entree,
            'sortie' => $sortie,
            'solde' => $entree - $sortie,
        ];
    }
}