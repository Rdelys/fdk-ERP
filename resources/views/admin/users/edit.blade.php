@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">Modifier Utilisateur</h3>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $user->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Actif</label>
        </div>

        <button class="btn btn-dark">Mettre à jour</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection