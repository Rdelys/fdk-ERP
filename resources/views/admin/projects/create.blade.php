@extends('layouts.admin')

@section('page-title', 'Créer un projet')
@section('page-subtitle', 'Ajoutez un nouveau projet à vendre')

@section('content')

    <div class="card-clean" style="max-width: 700px;">
        <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
            <span class="stat-icon bg-blue" style="margin-bottom:0;"><i class="fas fa-plus-circle"></i></span>
            <div>
                <h6 class="fw-bold mb-0">Nouveau Projet</h6>
                <small class="text-muted">Remplissez le formulaire ci-dessous</small>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label-custom">Nom du projet <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror"
                       placeholder="Ex: Site vitrine FDK" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Description</label>
                <textarea name="description" class="form-control form-control-custom @error('description') is-invalid @enderror"
                          rows="4" placeholder="Décrivez le projet en quelques lignes...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Une description claire aide à la compréhension du projet</small>
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Prix</label>
                <input type="number" step="0.01" name="price" class="form-control form-control-custom @error('price') is-invalid @enderror"
                       placeholder="0.00" value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Laissez vide si le prix n'est pas défini</small>
            </div>

            <div class="mb-4">
                <label class="form-label-custom">Guide PDF</label>
                <input type="file" name="guide_pdf" class="form-control form-control-custom @error('guide_pdf') is-invalid @enderror" accept="application/pdf">
                @error('guide_pdf')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Format accepté : PDF (max. 10 Mo)</small>
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Enregistrer
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-custom">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection