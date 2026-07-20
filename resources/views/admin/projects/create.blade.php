@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">Nouveau Projet</h3>

    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nom du projet</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix</label>
            <input type="number" step="0.01" name="price" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Guide PDF</label>
            <input type="file" name="guide_pdf" class="form-control" accept="application/pdf">
        </div>

        <button class="btn btn-dark">Enregistrer</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
@endsection