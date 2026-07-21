@extends('layouts.admin')

@section('page-title', 'Modifier le projet')
@section('page-subtitle', 'Mettez à jour les informations du projet')

@section('content')

    <div class="card-clean" style="max-width: 700px;">
        <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
            <span class="stat-icon bg-blue" style="margin-bottom:0;"><i class="fas fa-edit"></i></span>
            <div>
                <h6 class="fw-bold mb-0">Modifier Projet</h6>
                <small class="text-muted">{{ $project->name }}</small>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label-custom">Nom du projet <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror"
                       value="{{ old('name', $project->name) }}" required>
                @error('name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Description</label>
                <textarea name="description" class="form-control form-control-custom @error('description') is-invalid @enderror"
                          rows="4">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Prix</label>
                <input type="number" step="0.01" name="price" class="form-control form-control-custom @error('price') is-invalid @enderror"
                       value="{{ old('price', $project->price) }}">
                @error('price')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Guide PDF</label>
                @if ($project->guide_pdf)
                    <div class="alert-box alert-info-box mb-2">
                        <i class="fas fa-file-pdf"></i>
                        <a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank" class="text-decoration-none">
                            Voir le PDF actuel
                        </a>
                    </div>
                @endif
                <input type="file" name="guide_pdf" class="form-control form-control-custom @error('guide_pdf') is-invalid @enderror" accept="application/pdf">
                @error('guide_pdf')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
                <small class="text-muted"><i class="fas fa-info-circle me-1"></i>Laissez vide pour conserver le fichier actuel</small>
            </div>

            <div class="mb-4">
                <div class="form-check form-switch d-flex align-items-center gap-2 p-3" style="background: var(--bg); border-radius: 10px;">
                    <input type="checkbox" name="is_active" class="form-check-input" id="is_active" role="switch"
                           style="width: 42px; height: 22px;" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold mb-0" for="is_active">
                        Projet actif (visible par les prospecteurs)
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-sync-alt me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-custom">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection