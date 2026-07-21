@extends('layouts.admin')

@section('page-title', 'Finance')
@section('page-subtitle', 'Gestion des entrées et sorties d\'argent')

@section('content')

    <!-- Résumés par période -->
    <div class="row g-3 mb-4">
        @foreach ([['jour', 'Aujourd\'hui', $soldeJour], ['mois', 'Ce mois', $soldeMois], ['annee', 'Cette année', $soldeAnnee]] as [$key, $label, $solde])
            <div class="col-md-4">
                <div class="card-clean">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-bold mb-0">{{ $label }}</h6>
                        <span class="stat-icon bg-blue" style="width:34px;height:34px;font-size:0.9rem;margin-bottom:0;">
                            <i class="fas fa-wallet"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between small mb-1">
                        <span class="text-muted">Entrées</span>
                        <span class="text-success fw-semibold">+{{ number_format($solde['entree'], 0) }} Ar</span>
                    </div>
                    <div class="d-flex justify-content-between small mb-2">
                        <span class="text-muted">Sorties</span>
                        <span class="text-danger fw-semibold">-{{ number_format($solde['sortie'], 0) }} Ar</span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Solde</span>
                        <span class="fs-5 fw-bold {{ $solde['solde'] >= 0 ? 'text-success' : 'text-danger' }}">
                            {{ number_format($solde['solde'], 0) }} Ar
                        </span>
                    </div>
                    <small class="text-muted">Objectif : {{ number_format($objectifs[$key] ?? 0, 0) }} Ar</small>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <!-- Formulaire Objectifs -->
        <div class="col-lg-4">
            <div class="card-clean h-100">
                <h6 class="fw-bold mb-3"><i class="fas fa-bullseye text-primary me-2"></i>Objectifs</h6>
                <form method="POST" action="{{ route('admin.finance.objectifs.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label-custom">Objectif du jour</label>
                        <input type="number" step="0.01" name="objectif_jour" class="form-control form-control-custom" value="{{ $objectifs['jour'] ?? 0 }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Objectif du mois</label>
                        <input type="number" step="0.01" name="objectif_mois" class="form-control form-control-custom" value="{{ $objectifs['mois'] ?? 0 }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Objectif de l'année</label>
                        <input type="number" step="0.01" name="objectif_annee" class="form-control form-control-custom" value="{{ $objectifs['annee'] ?? 0 }}" required>
                    </div>
                    <button class="btn btn-primary-custom w-100">Enregistrer les objectifs</button>
                </form>
            </div>
        </div>

        <!-- Formulaire Transaction -->
        <div class="col-lg-4">
            <div class="card-clean h-100">
                <h6 class="fw-bold mb-3"><i class="fas fa-plus-circle text-primary me-2"></i>Ajouter une transaction</h6>
                <form method="POST" action="{{ route('admin.finance.transaction.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label-custom">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="entree">💰 Argent entrant</option>
                            <option value="sortie">📤 Argent sortant</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Montant</label>
                        <input type="number" step="0.01" name="montant" class="form-control form-control-custom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Description</label>
                        <input type="text" name="description" class="form-control form-control-custom" placeholder="Ex: Vente projet X">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Date</label>
                        <input type="date" name="date_transaction" class="form-control form-control-custom" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <button class="btn btn-primary-custom w-100">Ajouter la transaction</button>
                </form>
            </div>
        </div>

        <!-- Liste transactions -->
        <div class="col-lg-4">
            <div class="card-clean h-100">
                <h6 class="fw-bold mb-3"><i class="fas fa-list text-primary me-2"></i>Dernières transactions</h6>
                <div style="max-height: 420px; overflow-y: auto;">
                    @forelse ($transactions as $t)
                        <div class="d-flex justify-content-between align-items-start border-bottom py-2">
                            <div>
                                <span class="badge-custom {{ $t->type == 'entree' ? 'badge-vendu' : 'badge-non_vendu' }}">
                                    {{ $t->type == 'entree' ? 'Entrée' : 'Sortie' }}
                                </span>
                                <div class="small text-muted mt-1">{{ $t->date_transaction->format('d/m/Y') }} — {{ $t->description ?: 'Sans description' }}</div>
                            </div>
                            <div class="text-end">
                                <strong class="{{ $t->type == 'entree' ? 'text-success' : 'text-danger' }}">
                                    {{ $t->type == 'entree' ? '+' : '-' }}{{ number_format($t->montant, 0) }} Ar
                                </strong>
                                <form action="{{ route('admin.finance.transaction.destroy', $t) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-link text-danger p-0 d-block ms-auto" style="font-size: 0.75rem;">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">Aucune transaction enregistrée.</p>
                    @endforelse
                </div>
                <div class="mt-2">{{ $transactions->links() }}</div>
            </div>
        </div>
    </div>
@endsection