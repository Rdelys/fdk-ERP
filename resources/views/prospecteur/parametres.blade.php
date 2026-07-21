@extends('layouts.prospecteur')

@section('page-title', 'Mes paramètres')
@section('page-subtitle', 'Gérez votre profil et votre sécurité')

@section('content')

    <div class="card-clean" style="max-width: 650px;">
        <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
            <span class="stat-icon bg-blue" style="margin-bottom:0;"><i class="fas fa-user-cog"></i></span>
            <div>
                <h6 class="fw-bold mb-0">Mes Paramètres</h6>
                <small class="text-muted">Informations personnelles et mot de passe</small>
            </div>
        </div>

        <form method="POST" action="{{ route('prospecteur.parametres.update') }}">
            @csrf

            @if ($errors->any())
                <div class="alert-box alert-danger-box mb-3">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div class="small">{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label-custom">Nom complet <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Téléphone</label>
                <input type="text" name="phone" class="form-control form-control-custom @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $user->phone) }}" placeholder="06 12 34 56 78">
                @error('phone')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <hr class="my-4">

            <div class="alert-box alert-info-box mb-3">
                <i class="fas fa-info-circle"></i>
                <small>Laissez vide si vous ne voulez pas changer le mot de passe</small>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Nouveau mot de passe</label>
                <input type="password" name="password" class="form-control form-control-custom @error('password') is-invalid @enderror" placeholder="••••••••">
                @error('password')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control form-control-custom" placeholder="Confirmez votre mot de passe">
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
                <a href="{{ route('prospecteur.dashboard') }}" class="btn btn-outline-custom">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection