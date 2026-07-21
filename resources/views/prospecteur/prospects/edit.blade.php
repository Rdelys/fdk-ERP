@extends('layouts.prospecteur')

@section('page-title', 'Modifier le prospect')
@section('page-subtitle', 'Mettez à jour les informations et le statut')

@section('content')

    @php
        $statusLabels = ['en_cours' => 'En cours', 'vendu' => 'Vendu', 'non_vendu' => 'Non vendu'];
        $statusBadge = match($prospect->status) {
            'vendu' => 'badge-vendu', 'non_vendu' => 'badge-non_vendu', default => 'badge-en_cours',
        };
    @endphp

    <div class="card-clean" style="max-width: 650px;">
        <div class="d-flex align-items-center gap-2 mb-4 pb-3 border-bottom">
            <span class="stat-icon bg-blue" style="margin-bottom:0;"><i class="fas fa-user-edit"></i></span>
            <div class="flex-grow-1">
                <h6 class="fw-bold mb-0">{{ $prospect->name }}</h6>
                <small class="text-muted">Statut actuel :</small>
                <span class="badge-custom {{ $statusBadge }}">{{ $statusLabels[$prospect->status] ?? 'En cours' }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('prospecteur.prospects.update', $prospect) }}">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label-custom">Projet <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $prospect->project_id) == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Nom du prospect <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror"
                       value="{{ old('name', $prospect->name) }}" required>
                @error('name')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Téléphone</label>
                <input type="text" name="phone" class="form-control form-control-custom @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $prospect->phone) }}" placeholder="06 12 34 56 78">
                @error('phone')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Email</label>
                <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror"
                       value="{{ old('email', $prospect->email) }}" placeholder="jean.dupont@email.com">
                @error('email')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Notes</label>
                <textarea name="notes" class="form-control form-control-custom @error('notes') is-invalid @enderror"
                          rows="3">{{ old('notes', $prospect->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom mb-2">Statut <span class="text-danger">*</span></label>
                <div class="row g-2">
                    @foreach (['en_cours' => ['En cours', 'fa-clock', 'warning'], 'vendu' => ['Vendu', 'fa-check-circle', 'success'], 'non_vendu' => ['Non vendu', 'fa-times-circle', 'danger']] as $value => $meta)
                        <div class="col-4">
                            <input type="radio" name="status" id="status_{{ $value }}" value="{{ $value }}"
                                   class="btn-check" {{ old('status', $prospect->status) == $value ? 'checked' : '' }}>
                            <label for="status_{{ $value }}" class="btn btn-outline-custom w-100 d-flex flex-column align-items-center py-2"
                                   style="{{ old('status', $prospect->status) == $value ? 'border-color: var(--' . $meta[2] . '); background: var(--' . $meta[2] . '-light); color: var(--' . $meta[2] . ');' : '' }}">
                                <i class="fas {{ $meta[1] }} mb-1"></i>
                                <span style="font-size: 0.8rem;">{{ $meta[0] }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('status')
                    <div class="invalid-feedback d-block"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 pt-3 border-top">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-sync-alt me-1"></i> Mettre à jour
                </button>
                <a href="{{ route('prospecteur.prospects.index') }}" class="btn btn-outline-custom">
                    <i class="fas fa-times me-1"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection