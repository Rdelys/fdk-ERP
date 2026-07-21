@extends('layouts.admin')

@section('page-title', 'Gestion des projets')
@section('page-subtitle', 'Les projets proposés aux prospecteurs')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div></div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus-circle me-1"></i> Nouveau projet
        </a>
    </div>

    <div class="card-clean p-0">
        <div class="table-responsive">
            <table class="table table-clean mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Guide PDF</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="stat-icon bg-blue" style="width:34px;height:34px;font-size:0.85rem;margin-bottom:0;">
                                        <i class="fas fa-folder-open"></i>
                                    </span>
                                    <strong>{{ $project->name }}</strong>
                                </div>
                            </td>
                            <td>
                                @if ($project->price)
                                    <strong>{{ number_format($project->price, 2) }} Ar</strong>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($project->guide_pdf)
                                    <a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank" class="btn btn-sm btn-outline-custom">
                                        <i class="fas fa-file-pdf text-danger me-1"></i> Voir PDF
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-custom {{ $project->is_active ? 'badge-vendu' : 'badge-non_vendu' }}">
                                    {{ $project->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-custom">
                                        <i class="fas fa-pen"></i> Modifier
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Supprimer ce projet ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-custom text-danger">
                                            <i class="fas fa-trash-alt"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="text-center py-5">
                                    <i class="fas fa-box-open fs-1 text-muted mb-3 d-block"></i>
                                    <h6 class="fw-bold">Aucun projet</h6>
                                    <p class="text-muted small">Commencez par créer votre premier projet</p>
                                    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary-custom mt-2">
                                        <i class="fas fa-plus-circle me-1"></i> Créer un projet
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($projects->hasPages())
            <div class="p-3 border-top">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection