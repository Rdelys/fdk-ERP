@extends('layouts.prospecteur')

@section('page-title', 'Tableau de bord')
@section('user-info', 'Prospecteur')

@section('content')
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 22px 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border: 1px solid #eef0f5;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #1a3a6a);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(13, 31, 60, 0.12);
            border-color: rgba(255, 215, 0, 0.2);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 12px;
        }

        .stat-card .stat-icon.blue {
            background: rgba(26, 58, 106, 0.1);
            color: #1a3a6a;
        }

        .stat-card .stat-icon.green {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .stat-card .stat-icon.red {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .stat-card .stat-icon.orange {
            background: rgba(255, 193, 7, 0.12);
            color: #e0a800;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .stat-card .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: #0d1f3c;
            line-height: 1.2;
        }

        .stat-card .stat-value.text-success {
            color: #28a745;
        }

        .stat-card .stat-value.text-danger {
            color: #dc3545;
        }

        .stat-card .stat-value.text-warning {
            color: #e0a800;
        }

        .stat-card .stat-change {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 6px;
        }

        .stat-card .stat-change i {
            margin-right: 3px;
        }

        .stat-card .stat-change .up {
            color: #28a745;
        }

        .stat-card .stat-change .down {
            color: #dc3545;
        }

        /* Welcome Banner */
        .dashboard-welcome {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            border-radius: 16px;
            padding: 25px 30px;
            color: white;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .dashboard-welcome h5 {
            margin: 0;
            font-weight: 700;
        }

        .dashboard-welcome h5 i {
            color: #ffd700;
            margin-right: 10px;
        }

        .dashboard-welcome p {
            margin: 0;
            opacity: 0.8;
            font-size: 0.95rem;
        }

        .dashboard-welcome .badge-date {
            background: rgba(255, 215, 0, 0.2);
            color: #ffd700;
            padding: 8px 16px;
            border-radius: 10px;
            font-weight: 500;
        }

        .dashboard-welcome .badge-date i {
            margin-right: 6px;
        }

        /* Recent Activity */
        .recent-section {
            margin-top: 30px;
        }

        .recent-section .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .recent-section .section-header h6 {
            font-weight: 700;
            color: #0d1f3c;
            margin: 0;
        }

        .recent-section .section-header h6 i {
            color: #ffd700;
            margin-right: 8px;
        }

        .recent-section .section-header a {
            color: #1a3a6a;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .recent-section .section-header a:hover {
            color: #ffd700;
        }

        /* Animation d'entrée */
        .stat-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.2s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 15px;
            }

            .stat-card {
                padding: 18px 15px;
            }

            .stat-card .stat-value {
                font-size: 1.8rem;
            }

            .stat-card .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }

            .dashboard-welcome {
                padding: 20px;
                flex-direction: column;
                text-align: center;
            }

            .dashboard-welcome .badge-date {
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 15px 12px;
                border-radius: 12px;
            }

            .stat-card .stat-value {
                font-size: 1.5rem;
            }

            .stat-card .stat-label {
                font-size: 0.7rem;
            }

            .stat-card .stat-icon {
                width: 34px;
                height: 34px;
                font-size: 0.9rem;
                margin-bottom: 8px;
            }
        }
    </style>

    <!-- Welcome Banner -->
    <div class="dashboard-welcome">
        <div>
            <h5><i class="fas fa-chart-line"></i> Vue d'ensemble</h5>
            <p><i class="fas fa-calendar-alt"></i> Suivez votre activité en temps réel</p>
        </div>
        <div class="badge-date">
            <i class="fas fa-calendar-day"></i> {{ now()->format('d/m/Y') }}
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <!-- Total Prospects -->
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-address-book"></i>
            </div>
            <div class="stat-label">Total Prospects</div>
            <div class="stat-value">{{ $stats['total_prospects'] }}</div>
            <div class="stat-change">
                <i class="fas fa-list"></i> Au total
            </div>
        </div>

        <!-- Vendus -->
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-label">Vendus</div>
            <div class="stat-value text-success">{{ $stats['total_vendus'] }}</div>
            <div class="stat-change">
                <i class="fas fa-arrow-up up"></i> Convertis
            </div>
        </div>

        <!-- Non vendus -->
        <div class="stat-card">
            <div class="stat-icon red">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-label">Non vendus</div>
            <div class="stat-value text-danger">{{ $stats['total_non_vendus'] }}</div>
            <div class="stat-change">
                <i class="fas fa-arrow-down down"></i> À relancer
            </div>
        </div>

        <!-- En cours -->
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-label">En cours</div>
            <div class="stat-value text-warning">{{ $stats['total_en_cours'] }}</div>
            <div class="stat-change">
                <i class="fas fa-spinner fa-spin"></i> En traitement
            </div>
        </div>
    </div>

    <!-- Recent Activity (optional placeholder) -->
    <div class="recent-section">
        <div class="section-header">
            <h6><i class="fas fa-history"></i> Activité récente</h6>
            <a href="{{ route('prospecteur.prospects.index') }}">
                Voir tous <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="card p-4 text-center text-muted" style="border-radius: 12px; border: 2px dashed #e0e7f0;">
            <i class="fas fa-inbox" style="font-size: 2rem; color: #dce0e8; margin-bottom: 10px;"></i>
            <p style="margin: 0; font-size: 0.9rem;">Aucune activité récente à afficher</p>
        </div>
    </div>
@endsection