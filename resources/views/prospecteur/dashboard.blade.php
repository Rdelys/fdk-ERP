@extends('layouts.prospecteur')

@section('page-title', 'Tableau de bord')
@section('page-subtitle', 'Suivez votre performance en temps réel')

@section('content')

    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div>
            <h5><i class="fas fa-chart-line me-2"></i>Vue d'ensemble</h5>
            <p>Voici votre activité de prospection</p>
        </div>
        <div class="badge-date">
            <i class="fas fa-calendar-day me-1"></i> {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <!-- Top stats -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-blue"><i class="fas fa-address-book"></i></div>
                <div class="stat-label">Total Prospects</div>
                <div class="stat-value">{{ $stats['total_prospects'] }}</div>
                <span class="stat-trend up"><i class="fas fa-calendar-plus"></i> +{{ $stats['prospects_ce_mois'] }} ce mois</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-green"><i class="fas fa-check-circle"></i></div>
                <div class="stat-label">Vendus</div>
                <div class="stat-value">{{ $stats['total_vendus'] }}</div>
                <span class="stat-trend up"><i class="fas fa-fire"></i> {{ $stats['ventes_ce_mois'] }} ce mois</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-red"><i class="fas fa-times-circle"></i></div>
                <div class="stat-label">Non vendus</div>
                <div class="stat-value">{{ $stats['total_non_vendus'] }}</div>
                <span class="stat-trend down"><i class="fas fa-redo"></i> À relancer</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon bg-orange"><i class="fas fa-percentage"></i></div>
                <div class="stat-label">Taux de conversion</div>
                <div class="stat-value">{{ $stats['taux_conversion'] }}%</div>
                <span class="stat-trend {{ $stats['taux_conversion'] >= 30 ? 'up' : 'down' }}">
                    <i class="fas fa-bullseye"></i> Objectif 30%
                </span>
            </div>
        </div>
    </div>

    <!-- Objectif du mois -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            @php
                $couleurObj = $progressionObjectif >= 100 ? 'success' : ($progressionObjectif >= 50 ? 'info' : 'danger');
            @endphp
            <div class="alert-box alert-{{ $couleurObj }}-box">
                <i class="fas fa-bullseye fs-5"></i>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between mb-1">
                        <strong>Objectif du mois : {{ $stats['ventes_ce_mois'] }} / {{ $objectifVentes }} ventes</strong>
                        <span>{{ $progressionObjectif }}%</span>
                    </div>
                    <div class="progress-custom progress">
                        <div class="progress-bar bg-{{ $couleurObj }}" style="width: {{ $progressionObjectif }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <!-- Evolution des prospects -->
        <div class="col-lg-7">
            <div class="card-clean">
                <h6 class="fw-bold mb-3"><i class="fas fa-chart-area text-primary me-2"></i>Prospects ajoutés (7 derniers jours)</h6>
                <canvas id="chartProspects" height="110"></canvas>
            </div>
        </div>

        <!-- Répartition par projet -->
        <div class="col-lg-5">
            <div class="card-clean">
                <h6 class="fw-bold mb-3"><i class="fas fa-project-diagram text-primary me-2"></i>Performance par projet</h6>
                @forelse ($parProjet as $p)
                    @php
                        $tauxProjet = $p->total > 0 ? round(($p->ventes / $p->total) * 100) : 0;
                    @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <strong style="font-size: 0.9rem;">{{ $p->project->name ?? 'Projet supprimé' }}</strong>
                            <span class="text-muted small">{{ $p->ventes }}/{{ $p->total }} vendus</span>
                        </div>
                        <div class="progress-custom progress mt-1">
                            <div class="progress-bar bg-primary" style="width: {{ $tauxProjet }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small">Aucun prospect enregistré pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Activité récente -->
    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="card-clean d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h6 class="fw-bold mb-1"><i class="fas fa-history text-primary me-2"></i>Continuez sur votre lancée</h6>
                    <p class="text-muted mb-0 small">Consultez la liste complète de vos prospects pour faire vos relances.</p>
                </div>
                <a href="{{ route('prospecteur.prospects.index') }}" class="btn btn-primary-custom">
                    Voir mes prospects <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        new Chart(document.getElementById('chartProspects'), {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Prospects ajoutés',
                    data: @json($data),
                    backgroundColor: '#3b82f6',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { grid: { color: '#f1f5f9' }, beginAtZero: true, ticks: { stepSize: 1 } }, x: { grid: { display: false } } }
            }
        });
    </script>
@endsection