@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Projets</h3>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-dark">+ Nouveau projet</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Guide PDF</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->price ? number_format($project->price, 2) : '-' }}</td>
                    <td>
                        @if ($project->guide_pdf)
                            <a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank">Voir PDF</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $project->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $project->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce projet ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
@endsection