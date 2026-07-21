@extends('layouts.prospecteur')

@section('page-title', 'Nouveau prospect')
@section('page-subtitle', 'Ajoutez un nouveau contact')

@section('content')

    <div class="card-clean" style="max-width: 650px;">
        <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
            <span class="stat-icon bg-blue" style="margin-bottom:0;"><i class="fas fa-user-plus"></i></span>
            <div>
                <h6 class="fw-bold mb-0">Nouveau Prospect</h6>
                <small class="text-muted">Remplissez les informations ci-dessous</small>
            </div>
        </div>

        <form method="POST" action="{{ route('prospecteur.prospects.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label-custom">Projet <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
                    <option value="">-- Choisir un projet --</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Nom du prospect <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror"
                       placeholder="Jean Dupont" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Téléphone</label>
                <input type="text" name="phone" class="form-control form-control-custom @error('phone') is-invalid @enderror"
                       placeholder="06 12 34 56 78" value="{{ old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Email</label>
                <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror"
                       placeholder="jean.dupont@email.com" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Notes</label>
                <textarea name="notes" class="form-control form-control-custom @error('notes') is-invalid @enderror"
                          rows="3" placeholder="Informations complémentaires...">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
                <a href="{{ route('prospecteur.prospects.index') }}" class="btn btn-outline-custom">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection