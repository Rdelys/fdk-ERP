@extends('layouts.prospecteur')

@section('content')
    <h3 class="mb-4">Projets disponibles</h3>

    <div class="row g-3">
        @foreach ($projects as $project)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($project->description, 100) }}</p>
                        @if ($project->price)
                            <p><strong>{{ number_format($project->price, 2) }} Ar</strong></p>
                        @endif
                        @if ($project->guide_pdf)
                            <a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                📄 Voir le guide PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $projects->links() }}
@endsection