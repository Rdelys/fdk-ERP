@extends('layouts.prospecteur')

@section('page-title', 'Projets disponibles')
@section('page-subtitle', 'Découvrez les projets à vendre')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="badge-custom badge-en_cours">
            <i class="fas fa-list me-1"></i>{{ $projects->total() }} projet(s) disponible(s)
        </span>
    </div>

    @if ($projects->count() > 0)
        <div class="row g-3">
            @foreach ($projects as $project)
                <div class="col-md-6 col-lg-4">
                    <div class="project-tile">
                        <div class="tile-header">
                            <i class="fas fa-folder-open me-2"></i>{{ $project->name }}
                        </div>
                        <div class="tile-body">
                            <p class="text-muted small flex-grow-1">{{ Str::limit($project->description, 110) }}</p>
                            @if ($project->price)
                                <div class="d-flex align-items-center gap-2 p-2 mb-2" style="background: var(--bg); border-radius: 10px;">
                                    <i class="fas fa-tag text-primary"></i>
                                    <strong>{{ number_format($project->price, 0) }} Ar</strong>
                                </div>
                            @endif
                        </div>
                        <div class="tile-footer d-flex justify-content-between align-items-center">
                            @if ($project->guide_pdf)
                                <a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank" class="btn btn-sm btn-outline-custom">
                                    <i class="fas fa-file-pdf text-danger me-1"></i> Guide PDF
                                </a>
                            @else
                                <span class="text-muted small">Aucun guide</span>
                            @endif
                            <span class="badge-custom badge-vendu"><i class="fas fa-circle" style="font-size:6px;"></i> Actif</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($projects->hasPages())
            <div class="mt-4 d-flex justify-content-center">
                {{ $projects->links() }}
            </div>
        @endif
    @else
        <div class="card-clean text-center py-5">
            <i class="fas fa-box-open fs-1 text-muted mb-3 d-block"></i>
            <h6 class="fw-bold">Aucun projet disponible</h6>
            <p class="text-muted small">Revenez plus tard, de nouveaux projets seront bientôt ajoutés.</p>
        </div>
    @endif
@endsection