@extends('layouts.admin')

@section('page-title', 'Créer un utilisateur')
@section('page-subtitle', 'Ajoutez un nouveau prospecteur')

@section('content')

    <div class="card-clean" style="max-width: 600px;">
        <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
            <span class="stat-icon bg-blue" style="margin-bottom:0;"><i class="fas fa-user-plus"></i></span>
            <div>
                <h6 class="fw-bold mb-0">Nouvel Utilisateur</h6>
                <small class="text-muted">Compte Prospecteur</small>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label-custom">Nom complet <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror"
                       placeholder="Jean Dupont" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror"
                       placeholder="jean.dupont@example.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Téléphone</label>
                <input type="text" name="phone" class="form-control form-control-custom @error('phone') is-invalid @enderror"
                       placeholder="06 12 34 56 78" value="{{ old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="alert-box alert-info-box mb-4">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <strong>Accès sécurisé</strong><br>
                    <small>Un mot de passe sera généré automatiquement et envoyé par email à l'utilisateur.</small>
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-paper-plane me-1"></i> Créer et envoyer les accès
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-custom">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection