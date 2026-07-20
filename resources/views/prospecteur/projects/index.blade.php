@extends('layouts.prospecteur')

@section('page-title', 'Projets disponibles')
@section('user-info', 'Prospecteur')

@section('content')
    <style>
        .projects-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .projects-header h3 {
            margin: 0;
            font-weight: 700;
            color: #0d1f3c;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .projects-header h3 i {
            color: #ffd700;
        }

        .projects-header .projects-count {
            background: rgba(255, 215, 0, 0.12);
            color: #d4a800;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255, 215, 0, 0.15);
        }

        .projects-header .projects-count i {
            color: #ffd700;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .project-card {
            background: white;
            border-radius: 16px;
            padding: 0;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #eef0f5;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .project-card:nth-child(1) { animation-delay: 0.05s; }
        .project-card:nth-child(2) { animation-delay: 0.1s; }
        .project-card:nth-child(3) { animation-delay: 0.15s; }
        .project-card:nth-child(4) { animation-delay: 0.2s; }
        .project-card:nth-child(5) { animation-delay: 0.25s; }
        .project-card:nth-child(6) { animation-delay: 0.3s; }

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

        .project-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(13, 31, 60, 0.12);
            border-color: rgba(255, 215, 0, 0.2);
        }

        .project-card .card-header {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            padding: 18px 20px;
            position: relative;
            overflow: hidden;
        }

        .project-card .card-header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20px;
            width: 80px;
            height: 80px;
            background: rgba(255, 215, 0, 0.05);
            border-radius: 50%;
        }

        .project-card .card-header .project-icon {
            color: #ffd700;
            font-size: 1.2rem;
            margin-right: 10px;
        }

        .project-card .card-header h5 {
            color: white;
            font-weight: 700;
            margin: 0;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        .project-card .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .project-card .card-body .description {
            color: #4a5568;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 16px;
            flex: 1;
        }

        .project-card .card-body .price-section {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            padding: 10px 14px;
            background: #f8f9ff;
            border-radius: 10px;
            border: 1px solid #eef0f5;
        }

        .project-card .card-body .price-section i {
            color: #ffd700;
            font-size: 1.1rem;
        }

        .project-card .card-body .price-section .price {
            font-weight: 700;
            color: #0d1f3c;
            font-size: 1.1rem;
        }

        .project-card .card-body .price-section .price-currency {
            color: #ffd700;
            font-weight: 600;
        }

        .project-card .card-body .price-section .price-label {
            color: #6c757d;
            font-size: 0.75rem;
            margin-left: auto;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .project-card .card-footer {
            padding: 15px 20px;
            background: #fafbfc;
            border-top: 1px solid #eef0f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .project-card .card-footer .btn-pdf {
            background: rgba(26, 58, 106, 0.08);
            color: #1a3a6a;
            border: 1px solid rgba(26, 58, 106, 0.1);
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .project-card .card-footer .btn-pdf:hover {
            background: #0d1f3c;
            color: white;
            border-color: #0d1f3c;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 31, 60, 0.2);
        }

        .project-card .card-footer .btn-pdf i {
            color: #dc3545;
        }

        .project-card .card-footer .btn-pdf:hover i {
            color: #ffd700;
        }

        .project-card .card-footer .project-status {
            font-size: 0.7rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .project-card .card-footer .project-status i {
            color: #28a745;
            font-size: 0.6rem;
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .pagination-wrapper .pagination {
            margin: 0;
        }

        .pagination-wrapper .page-link {
            border: none;
            color: #1a3a6a;
            border-radius: 8px;
            margin: 0 3px;
            padding: 8px 16px;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .pagination-wrapper .page-link:hover {
            background: rgba(26, 58, 106, 0.08);
            color: #0d1f3c;
        }

        .pagination-wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
        }

        .pagination-wrapper .page-item.disabled .page-link {
            color: #adb5bd;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 16px;
            border: 2px dashed #e0e7f0;
        }

        .empty-state i {
            font-size: 3.5rem;
            color: #dce0e8;
            margin-bottom: 15px;
        }

        .empty-state h5 {
            color: #0d1f3c;
            font-weight: 600;
        }

        .empty-state p {
            color: #6c757d;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .project-grid {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
            .project-grid {
                grid-template-columns: 1fr 1fr;
                gap: 14px;
            }

            .projects-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .projects-header .projects-count {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .project-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .project-card .card-header h5 {
                font-size: 1rem;
            }

            .project-card .card-body .description {
                font-size: 0.85rem;
            }

            .project-card .card-body .price-section .price {
                font-size: 1rem;
            }

            .project-card .card-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .project-card .card-footer .btn-pdf {
                justify-content: center;
            }

            .project-card .card-footer .project-status {
                justify-content: center;
            }
        }
    </style>

    <!-- Header -->
    <div class="projects-header">
        <h3>
            <i class="fas fa-project-diagram"></i>
            Projets disponibles
        </h3>
        <span class="projects-count">
            <i class="fas fa-list"></i>
            {{ $projects->total() }} projet(s) disponible(s)
        </span>
    </div>

    <!-- Grid -->
    @if ($projects->count() > 0)
        <div class="project-grid">
            @foreach ($projects as $project)
                <div class="project-card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h5>
                            <i class="fas fa-folder-open project-icon"></i>
                            {{ $project->name }}
                        </h5>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="description">
                            {{ Str::limit($project->description, 120) }}
                        </div>

                        @if ($project->price)
                            <div class="price-section">
                                <i class="fas fa-tag"></i>
                                <span class="price">
                                    <span class="price-currency">Ar</span> {{ number_format($project->price, 2) }}
                                </span>
                                <span class="price-label">
                                    <i class="fas fa-info-circle"></i> Prix
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer">
                        @if ($project->guide_pdf)
                            <a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank" class="btn-pdf">
                                <i class="fas fa-file-pdf"></i> Voir le guide PDF
                            </a>
                        @else
                            <span class="btn-pdf" style="opacity: 0.5; cursor: default;">
                                <i class="fas fa-file-pdf"></i> Aucun guide
                            </span>
                        @endif

                        <span class="project-status">
                            <i class="fas fa-circle"></i>
                            Disponible
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if ($projects->hasPages())
            <div class="pagination-wrapper">
                {{ $projects->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h5>Aucun projet disponible</h5>
            <p>Revenez plus tard, de nouveaux projets seront bientôt ajoutés.</p>
        </div>
    @endif
@endsection