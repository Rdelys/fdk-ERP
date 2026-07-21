@extends('layouts.admin')

@section('page-title', "Modifier l'utilisateur")
@section('page-subtitle', 'Mettez à jour les informations du prospecteur')

@section('content')

    <div class="card-clean" style="max-width: 600px;">
        <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
            <span class="stat-icon bg-blue" style="margin-bottom:0;"><i class="fas fa-user-edit"></i></span>
            <div>
                <h6 class="fw-bold mb-0">Modifier Utilisateur</h6>
                <small class="text-muted">{{ $user->name }}</small>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')

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
                       value="{{ old('phone', $user->phone) }}" placeholder="Ex: 06 12 34 56 78">
                @error('phone')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <div class="form-check form-switch d-flex align-items-center gap-2 p-3" style="background: var(--bg); border-radius: 10px;">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" role="switch"
                           style="width: 42px; height: 22px;" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold mb-0" for="is_active">
                        Utilisateur actif
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-sync-alt me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-custom">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection