@extends('layouts.prospecteur')

@section('page-title', 'Mes prospects')
@section('user-info', 'Prospecteur')

@section('content')
    <style>
        .prospects-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .prospects-header h3 {
            margin: 0;
            font-weight: 700;
            color: #0d1f3c;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .prospects-header h3 i {
            color: #ffd700;
        }

        .prospects-header .btn-create {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 22px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .prospects-header .btn-create:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 31, 60, 0.3);
            color: white;
            text-decoration: none;
        }

        .prospects-header .btn-create i {
            color: #ffd700;
        }

        .table-wrapper {
            background: white;
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #eef0f5;
        }

        .table-wrapper .table {
            margin: 0;
        }

        .table-wrapper .table thead {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
        }

        .table-wrapper .table thead th {
            padding: 14px 18px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }

        .table-wrapper .table thead th i {
            color: #ffd700;
            margin-right: 6px;
            font-size: 0.8rem;
        }

        .table-wrapper .table tbody tr {
            border-bottom: 1px solid #f0f2f6;
        }

        .table-wrapper .table tbody tr:last-child {
            border-bottom: none;
        }

        .table-wrapper .table tbody td {
            padding: 14px 18px;
            vertical-align: middle;
            color: #2d3748;
        }

        .table-wrapper .table tbody td .prospect-name {
            font-weight: 600;
            color: #0d1f3c;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-wrapper .table tbody td .prospect-name i {
            color: #ffd700;
        }

        .table-wrapper .table tbody td .project-name {
            color: #1a3a6a;
            font-weight: 500;
        }

        .table-wrapper .table tbody td .project-name i {
            color: #6c757d;
            margin-right: 4px;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.3px;
        }

        .badge-status.vendu {
            background: #d4edda;
            color: #155724;
        }

        .badge-status.vendu i {
            color: #28a745;
        }

        .badge-status.non_vendu {
            background: #f8d7da;
            color: #721c24;
        }

        .badge-status.non_vendu i {
            color: #dc3545;
        }

        .badge-status.en_cours {
            background: #fff3cd;
            color: #856404;
        }

        .badge-status.en_cours i {
            color: #e0a800;
        }

        .actions-group {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .actions-group .btn-action {
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: 1px solid transparent;
            text-decoration: none;
            cursor: pointer;
        }

        .actions-group .btn-action i {
            font-size: 0.85rem;
        }

        .actions-group .btn-edit {
            background: rgba(26, 58, 106, 0.08);
            color: #1a3a6a;
            border-color: rgba(26, 58, 106, 0.1);
        }

        .actions-group .btn-edit:hover {
            background: #1a3a6a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(26, 58, 106, 0.25);
            text-decoration: none;
        }

        .actions-group .btn-delete {
            background: rgba(220, 53, 69, 0.08);
            color: #dc3545;
            border-color: rgba(220, 53, 69, 0.1);
        }

        .actions-group .btn-delete:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);
        }

        .table-wrapper .pagination-wrapper {
            padding: 15px 18px;
            background: #fafbfc;
            border-top: 1px solid #eef0f5;
        }

        .table-wrapper .pagination-wrapper .pagination {
            margin: 0;
        }

        .table-wrapper .pagination-wrapper .page-link {
            border: none;
            color: #1a3a6a;
            border-radius: 8px;
            margin: 0 2px;
            padding: 6px 14px;
            transition: all 0.2s ease;
        }

        .table-wrapper .pagination-wrapper .page-link:hover {
            background: rgba(26, 58, 106, 0.08);
            color: #0d1f3c;
        }

        .table-wrapper .pagination-wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
        }

        .table-wrapper .pagination-wrapper .page-item.disabled .page-link {
            color: #adb5bd;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 3rem;
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

        @media (max-width: 992px) {
            .table-wrapper {
                overflow-x: auto;
                border-radius: 12px;
            }

            .table-wrapper .table {
                min-width: 700px;
            }
        }

        @media (max-width: 576px) {
            .prospects-header {
                flex-direction: column;
                align-items: stretch;
            }

            .prospects-header .btn-create {
                justify-content: center;
            }

            .table-wrapper .table thead th,
            .table-wrapper .table tbody td {
                padding: 10px 12px;
                font-size: 0.85rem;
            }

            .actions-group .btn-action {
                padding: 4px 10px;
                font-size: 0.75rem;
            }

            .table-wrapper .pagination-wrapper {
                padding: 12px 15px;
            }
        }
    </style>

    <div class="prospects-header">
        <h3>
            <i class="fas fa-address-book"></i>
            Mes Prospects
        </h3>
        <a href="{{ route('prospecteur.prospects.create') }}" class="btn-create">
            <i class="fas fa-user-plus"></i> Nouveau prospect
        </a>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th><i class="fas fa-user"></i> Nom</th>
                    <th><i class="fas fa-project-diagram"></i> Projet</th>
                    <th><i class="fas fa-phone"></i> Téléphone</th>
                    <th><i class="fas fa-circle"></i> Statut</th>
                    <th><i class="fas fa-cog"></i> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($prospects as $prospect)
                    <tr>
                        <td>
                            <span class="prospect-name">
                                <i class="fas fa-user-circle"></i>
                                {{ $prospect->name }}
                            </span>
                        </td>
                        <td>
                            <span class="project-name">
                                <i class="fas fa-folder-open"></i>
                                {{ $prospect->project->name }}
                            </span>
                        </td>
                        <td>
                            @if ($prospect->phone)
                                <i class="fas fa-phone" style="color: #ffd700; margin-right: 4px;"></i>
                                {{ $prospect->phone }}
                            @else
                                <span style="color: #adb5bd;">-</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $badgeClass = match($prospect->status) {
                                    'vendu' => 'vendu',
                                    'non_vendu' => 'non_vendu',
                                    default => 'en_cours',
                                };
                                $icon = match($prospect->status) {
                                    'vendu' => 'fa-check-circle',
                                    'non_vendu' => 'fa-times-circle',
                                    default => 'fa-clock',
                                };
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">
                                <i class="fas {{ $icon }}"></i>
                                {{ str_replace('_', ' ', $prospect->status) }}
                            </span>
                        </td>
                        <td>
                            <div class="actions-group">
                                <a href="{{ route('prospecteur.prospects.edit', $prospect) }}" class="btn-action btn-edit">
                                    <i class="fas fa-pen"></i> Modifier
                                </a>
                                <form action="{{ route('prospecteur.prospects.destroy', $prospect) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce prospect ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-users-slash"></i>
                                <h5>Aucun prospect</h5>
                                <p>Commencez par créer votre premier prospect</p>
                                <a href="{{ route('prospecteur.prospects.create') }}" class="btn btn-dark mt-2">
                                    <i class="fas fa-user-plus"></i> Créer un prospect
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($prospects->hasPages())
            <div class="pagination-wrapper">
                {{ $prospects->links() }}
            </div>
        @endif
    </div>
@endsection