@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">Modifier Projet</h3>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom du projet</label>
            <input type="text" name="name" class="form-control" value="{{ $project->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $project->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $project->price }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Guide PDF actuel</label>
            @if ($project->guide_pdf)
                <p><a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank">Voir le PDF actuel</a></p>
            @endif
            <input type="file" name="guide_pdf" class="form-control" accept="application/pdf">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ $project->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Actif</label>
        </div>

        <button class="btn btn-dark">Mettre à jour</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection