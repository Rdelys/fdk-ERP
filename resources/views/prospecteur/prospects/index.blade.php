@extends('layouts.prospecteur')

@section('page-title', 'Mes prospects')
@section('page-subtitle', 'Gérez vos prospects et suivez vos ventes')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div></div>
        <a href="{{ route('prospecteur.prospects.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-user-plus me-1"></i> Nouveau prospect
        </a>
    </div>

    <div class="card-clean p-0">
        <div class="table-responsive">
            <table class="table table-clean mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Projet</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($prospects as $prospect)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rank-avatar" style="background: var(--primary); width:34px; height:34px; font-size:0.72rem;">
                                        {{ strtoupper(substr($prospect->name, 0, 2)) }}
                                    </div>
                                    <strong>{{ $prospect->name }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted"><i class="fas fa-folder-open me-1"></i>{{ $prospect->project->name }}</span>
                            </td>
                            <td>
                                @if ($prospect->phone)
                                    <i class="fas fa-phone text-primary me-1"></i>{{ $prospect->phone }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $badge = match($prospect->status) {
                                        'vendu' => 'badge-vendu',
                                        'non_vendu' => 'badge-non_vendu',
                                        default => 'badge-en_cours',
                                    };
                                    $label = match($prospect->status) {
                                        'vendu' => 'Vendu',
                                        'non_vendu' => 'Non vendu',
                                        default => 'En cours',
                                    };
                                @endphp
                                <span class="badge-custom {{ $badge }}">{{ $label }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('prospecteur.prospects.edit', $prospect) }}" class="btn btn-sm btn-outline-custom">
                                        <i class="fas fa-pen"></i> Modifier
                                    </a>
                                    <form action="{{ route('prospecteur.prospects.destroy', $prospect) }}" method="POST" onsubmit="return confirm('Supprimer ce prospect ?')">
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
                                    <i class="fas fa-users-slash fs-1 text-muted mb-3 d-block"></i>
                                    <h6 class="fw-bold">Aucun prospect</h6>
                                    <p class="text-muted small">Commencez par créer votre premier prospect</p>
                                    <a href="{{ route('prospecteur.prospects.create') }}" class="btn btn-primary-custom mt-2">
                                        <i class="fas fa-user-plus me-1"></i> Créer un prospect
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($prospects->hasPages())
            <div class="p-3 border-top">
                {{ $prospects->links() }}
            </div>
        @endif
    </div>
@endsection