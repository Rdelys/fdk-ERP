@extends('layouts.admin')

@section('page-title', 'Gestion des utilisateurs')
@section('page-subtitle', 'Les prospecteurs ayant accès à la plateforme')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div></div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-user-plus me-1"></i> Nouvel utilisateur
        </a>
    </div>

    <div class="card-clean p-0">
        <div class="table-responsive">
            <table class="table table-clean mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rank-avatar" style="background: var(--primary); width:36px; height:36px; font-size:0.75rem;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <strong>{{ $user->name }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted">
                                    <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                                </span>
                            </td>
                            <td>
                                @if ($user->phone)
                                    <i class="fas fa-phone text-primary me-1"></i>{{ $user->phone }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge-custom {{ $user->is_active ? 'badge-vendu' : 'badge-non_vendu' }}">
                                    {{ $user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-custom">
                                        <i class="fas fa-pen"></i> Modifier
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
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
                                    <h6 class="fw-bold">Aucun utilisateur</h6>
                                    <p class="text-muted small">Commencez par créer votre premier utilisateur</p>
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary-custom mt-2">
                                        <i class="fas fa-user-plus me-1"></i> Créer un utilisateur
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="p-3 border-top">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection