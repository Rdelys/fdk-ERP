@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">Nouvel Utilisateur (Prospecteur)</h3>

    <form method="POST" action="{{ route('admin.users.store') }}" class="bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom complet</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <p class="text-muted small">Un mot de passe sera généré automatiquement et envoyé par email.</p>

        <button class="btn btn-dark">Créer et envoyer les accès</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection