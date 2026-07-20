@extends('layouts.prospecteur')

@section('content')
    <h3 class="mb-4">Modifier Prospect</h3>

    <form method="POST" action="{{ route('prospecteur.prospects.update', $prospect) }}" class="bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Projet</label>
            <select name="project_id" class="form-control" required>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ $prospect->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nom du prospect</label>
            <input type="text" name="name" class="form-control" value="{{ $prospect->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="phone" class="form-control" value="{{ $prospect->phone }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $prospect->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3">{{ $prospect->notes }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Statut (Vendu ou pas)</label>
            <select name="status" class="form-control" required>
                <option value="en_cours" {{ $prospect->status == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="vendu" {{ $prospect->status == 'vendu' ? 'selected' : '' }}>Vendu</option>
                <option value="non_vendu" {{ $prospect->status == 'non_vendu' ? 'selected' : '' }}>Non vendu</option>
            </select>
        </div>

        <button class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('prospecteur.prospects.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection