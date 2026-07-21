<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinanceObjectif;
use App\Models\FinanceTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FinanceController extends Controller
{
    public function index()
    {
        $transactions = FinanceTransaction::orderByDesc('date_transaction')->paginate(15);

        $objectifs = FinanceObjectif::pluck('montant', 'periode');

        $today = Carbon::today();

        $soldeJour = $this->solde($today, $today);
        $soldeMois = $this->solde($today->copy()->startOfMonth(), $today->copy()->endOfMonth());
        $soldeAnnee = $this->solde($today->copy()->startOfYear(), $today->copy()->endOfYear());

        return view('admin.finance.index', [
            'transactions' => $transactions,
            'objectifs' => $objectifs,
            'soldeJour' => $soldeJour,
            'soldeMois' => $soldeMois,
            'soldeAnnee' => $soldeAnnee,
        ]);
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

    public function storeTransaction(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:entree,sortie',
            'montant' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
            'date_transaction' => 'required|date',
        ]);

        FinanceTransaction::create($data);

        return back()->with('success', 'Transaction enregistrée');
    }

    public function destroyTransaction(FinanceTransaction $transaction)
    {
        $transaction->delete();
        return back()->with('success', 'Transaction supprimée');
    }

    public function updateObjectifs(Request $request)
    {
        $data = $request->validate([
            'objectif_jour' => 'required|numeric|min:0',
            'objectif_mois' => 'required|numeric|min:0',
            'objectif_annee' => 'required|numeric|min:0',
        ]);

        FinanceObjectif::updateOrCreate(['periode' => 'jour'], ['montant' => $data['objectif_jour']]);
        FinanceObjectif::updateOrCreate(['periode' => 'mois'], ['montant' => $data['objectif_mois']]);
        FinanceObjectif::updateOrCreate(['periode' => 'annee'], ['montant' => $data['objectif_annee']]);

        return back()->with('success', 'Objectifs mis à jour');
    }
}