@extends('layouts.admin')

@section('page-title', 'Vue d\'ensemble')
@section('page-subtitle', 'Suivi de l\'activité en temps réel')

@section('content')

    <!-- Top stats -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-2">
            <div class="stat-card">
                <div class="stat-icon bg-blue"><i class="fas fa-folder-open"></i></div>
                <div class="stat-label">Projets</div>
                <div class="stat-value">{{ $stats['total_projects'] }}</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="stat-card">
                <div class="stat-icon bg-blue"><i class="fas fa-users"></i></div>
                <div class="stat-label">Prospecteurs</div>
                <div class="stat-value">{{ $stats['total_prospecteurs'] }}</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="stat-card">
                <div class="stat-icon bg-orange"><i class="fas fa-address-book"></i></div>
                <div class="stat-label">Prospects</div>
                <div class="stat-value">{{ $stats['total_prospects'] }}</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="stat-card">
                <div class="stat-icon bg-green"><i class="fas fa-check-circle"></i></div>
                <div class="stat-label">Vendus</div>
                <div class="stat-value">{{ $stats['total_vendus'] }}</div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="stat-card">
                <div class="stat-icon bg-{{ $alertes['jour']['couleur'] == 'success' ? 'green' : ($alertes['jour']['couleur'] == 'danger' ? 'red' : 'blue') }}">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-label">Solde du jour</div>
                <div class="stat-value">{{ number_format($finance['jour']['solde'], 0) }}</div>
                <span class="stat-trend {{ $alertes['jour']['pourcentage'] >= 100 ? 'up' : 'down' }}">
                    {{ $alertes['jour']['pourcentage'] }}% objectif
                </span>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="stat-card">
                <div class="stat-icon bg-{{ $alertes['mois']['couleur'] == 'success' ? 'green' : ($alertes['mois']['couleur'] == 'danger' ? 'red' : 'blue') }}">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-label">Solde du mois</div>
                <div class="stat-value">{{ number_format($finance['mois']['solde'], 0) }}</div>
                <span class="stat-trend {{ $alertes['mois']['pourcentage'] >= 100 ? 'up' : 'down' }}">
                    {{ $alertes['mois']['pourcentage'] }}% objectif
                </span>
            </div>
        </div>
    </div>

    <!-- Alertes finance -->
    <div class="row g-3 mb-4">
        @foreach (['jour' => ['Aujourd\'hui', 'fa-calendar-day'], 'mois' => ['Ce mois', 'fa-calendar-alt'], 'annee' => ['Cette année', 'fa-calendar']] as $key => $meta)
            @php
                $boxClass = $alertes[$key]['couleur'] == 'success' ? 'alert-success-box' : ($alertes[$key]['couleur'] == 'danger' ? 'alert-danger-box' : 'alert-info-box');
                $icon = $alertes[$key]['couleur'] == 'success' ? 'fa-circle-check' : ($alertes[$key]['couleur'] == 'danger' ? 'fa-triangle-exclamation' : 'fa-circle-info');
            @endphp
            <div class="col-md-4">
                <div class="alert-box {{ $boxClass }}">
                    <i class="fas {{ $icon }} fs-5"></i>
                    <div>
                        <strong>Objectif {{ $meta[0] }} :</strong> {{ $alertes[$key]['pourcentage'] }}% atteint<br>
                        <small>{{ number_format($finance[$key]['solde'], 0) }} / {{ number_format($objectifs[$key] ?? 0, 0) }} Ar</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <!-- Graphique évolution -->
        <div class="col-lg-7">
            <div class="card-clean">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="mb-0 fw-bold">Évolution du solde</h6>
                        <small class="text-muted">7 derniers jours</small>
                    </div>
                </div>
                <canvas id="chartCA" height="110"></canvas>
            </div>
        </div>

        <!-- Classement prospecteurs -->
        <div class="col-lg-5">
            <div class="card-clean">
                <h6 class="fw-bold mb-3"><i class="fas fa-trophy text-warning me-2"></i>Top Prospecteurs</h6>
                @php $colors = ['#3b82f6', '#06b6d4', '#10b981', '#f59e0b', '#ef4444']; @endphp
                @forelse ($classement as $i => $user)
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rank-avatar" style="background: {{ $colors[$i] ?? '#94a3b8' }}">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <strong style="font-size: 0.9rem;">{{ $user->name }}</strong>
                                <span class="text-primary fw-bold" style="font-size: 0.9rem;">{{ $user->ventes_count }} ventes</span>
                            </div>
                            <div class="progress-custom progress mt-1">
                                <div class="progress-bar" style="width: {{ $user->pourcentage }}%; background: {{ $colors[$i] ?? '#94a3b8' }}"></div>
                            </div>
                            <small class="text-muted">Objectif : {{ $user->pourcentage }}%</small>
                        </div>
                    </div>
                @empty
                    <p class="text-muted small">Aucun prospecteur pour le moment.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-12">
            <div class="card-clean">
                <h6 class="fw-bold mb-3">Prospects vs Ventes par Prospecteur</h6>
                <canvas id="chartProspecteurs" height="80"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        Chart.defaults.font.family = "'Segoe UI', sans-serif";

        new Chart(document.getElementById('chartCA'), {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Solde (Ar)',
                    data: @json($data),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#3b82f6',
                    pointRadius: 4,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { grid: { color: '#f1f5f9' } }, x: { grid: { display: false } } }
            }
        });

        new Chart(document.getElementById('chartProspecteurs'), {
            type: 'bar',
            data: {
                labels: @json($classement->pluck('name')),
                datasets: [
                    {
                        label: 'Total Prospects',
                        data: @json($classement->pluck('prospects_count')),
                        backgroundColor: '#93c5fd',
                        borderRadius: 6,
                    },
                    {
                        label: 'Ventes',
                        data: @json($classement->pluck('ventes_count')),
                        backgroundColor: '#3b82f6',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true,
                scales: { y: { grid: { color: '#f1f5f9' } }, x: { grid: { display: false } } }
            }
        });
    </script>
@endsection