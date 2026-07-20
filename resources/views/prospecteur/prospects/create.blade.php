@extends('layouts.prospecteur')

@section('content')
    <h3 class="mb-4">Nouveau Prospect</h3>

    <form method="POST" action="{{ route('prospecteur.prospects.store') }}" class="bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
        @csrf

        <div class="mb-3">
            <label class="form-label">Projet</label>
            <select name="project_id" class="form-control" required>
                <option value="">-- Choisir un projet --</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nom du prospect</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('prospecteur.prospects.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection