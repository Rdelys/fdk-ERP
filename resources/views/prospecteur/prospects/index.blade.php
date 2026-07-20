@extends('layouts.prospecteur')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Mes Prospects</h3>
        <a href="{{ route('prospecteur.prospects.create') }}" class="btn btn-primary">+ Nouveau prospect</a>
    </div>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Projet</th>
                <th>Téléphone</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prospects as $prospect)
                <tr>
                    <td>{{ $prospect->name }}</td>
                    <td>{{ $prospect->project->name }}</td>
                    <td>{{ $prospect->phone ?? '-' }}</td>
                    <td>
                        @php
                            $badge = match($prospect->status) {
                                'vendu' => 'bg-success',
                                'non_vendu' => 'bg-danger',
                                default => 'bg-warning text-dark',
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ str_replace('_', ' ', $prospect->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('prospecteur.prospects.edit', $prospect) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form action="{{ route('prospecteur.prospects.destroy', $prospect) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce prospect ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $prospects->links() }}
@endsection