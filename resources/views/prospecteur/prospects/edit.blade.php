@extends('layouts.prospecteur')

@section('page-title', 'Modifier le prospect')
@section('user-info', 'Prospecteur')

@section('content')
    <style>
        .form-container {
            background: white;
            border-radius: 16px;
            padding: 30px 35px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #eef0f5;
            max-width: 650px;
        }

        .form-container .form-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f2f6;
        }

        .form-container .form-header h3 {
            margin: 0;
            font-weight: 700;
            color: #0d1f3c;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-container .form-header h3 i {
            color: #ffd700;
        }

        .form-container .form-header .edit-badge {
            background: rgba(255, 215, 0, 0.15);
            color: #d4a800;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 5px;
            border: 1px solid rgba(255, 215, 0, 0.2);
        }

        .form-container .form-header .edit-badge i {
            color: #ffd700;
        }

        .form-container .form-label {
            font-weight: 600;
            color: #0d1f3c;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-container .form-label i {
            color: #ffd700;
            width: 18px;
        }

        .form-container .form-label .required {
            color: #dc3545;
            font-weight: 700;
        }

        .form-container .form-control {
            border-radius: 10px;
            border: 2px solid #e0e7f0;
            padding: 10px 16px;
            transition: all 0.2s ease;
        }

        .form-container .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.15);
        }

        .form-container .form-control::placeholder {
            color: #adb5bd;
            font-size: 0.9rem;
        }

        .form-container select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236c757d' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
        }

        .form-container textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .form-container .status-options {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
        }

        .form-container .status-options .status-option {
            position: relative;
        }

        .form-container .status-options .status-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .form-container .status-options .status-option label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 8px;
            border: 2px solid #e0e7f0;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fafbfc;
            text-align: center;
            font-weight: 500;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .form-container .status-options .status-option label i {
            font-size: 1.2rem;
            margin-bottom: 4px;
        }

        .form-container .status-options .status-option input[type="radio"]:checked + label {
            border-color: #ffd700;
            background: #fffdf5;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.1);
            color: #0d1f3c;
        }

        .form-container .status-options .status-option input[type="radio"]:checked + label .status-vendu {
            color: #28a745;
        }

        .form-container .status-options .status-option input[type="radio"]:checked + label .status-non-vendu {
            color: #dc3545;
        }

        .form-container .status-options .status-option input[type="radio"]:checked + label .status-en-cours {
            color: #e0a800;
        }

        .form-container .btn-group-actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #f0f2f6;
            flex-wrap: wrap;
        }

        .form-container .btn-group-actions .btn-submit {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .form-container .btn-group-actions .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 31, 60, 0.3);
        }

        .form-container .btn-group-actions .btn-submit i {
            color: #ffd700;
        }

        .form-container .btn-group-actions .btn-cancel {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #e0e7f0;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .form-container .btn-group-actions .btn-cancel:hover {
            background: #e9ecef;
            border-color: #ced4da;
            color: #495057;
            text-decoration: none;
        }

        .form-container .btn-group-actions .btn-cancel i {
            color: #6c757d;
        }

        .form-container .is-invalid {
            border-color: #dc3545;
        }

        .form-container .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
        }

        .form-container .invalid-feedback {
            font-size: 0.8rem;
            color: #dc3545;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 4px;
        }

        .form-container .invalid-feedback i {
            font-size: 0.7rem;
        }

        /* Current status badge */
        .current-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: 8px;
        }

        .current-status.vendu {
            background: #d4edda;
            color: #155724;
        }

        .current-status.non_vendu {
            background: #f8d7da;
            color: #721c24;
        }

        .current-status.en_cours {
            background: #fff3cd;
            color: #856404;
        }

        @media (max-width: 768px) {
            .form-container .status-options {
                grid-template-columns: 1fr 1fr 1fr;
                gap: 8px;
            }

            .form-container .status-options .status-option label {
                padding: 10px 6px;
                font-size: 0.75rem;
            }

            .form-container .status-options .status-option label i {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 20px;
                border-radius: 12px;
            }

            .form-container .form-header {
                flex-wrap: wrap;
            }

            .form-container .form-header .edit-badge {
                margin-left: 0;
                width: 100%;
                justify-content: center;
            }

            .form-container .form-header h3 {
                font-size: 1.2rem;
            }

            .form-container .btn-group-actions {
                flex-direction: column;
            }

            .form-container .btn-group-actions .btn-submit,
            .form-container .btn-group-actions .btn-cancel {
                justify-content: center;
                width: 100%;
            }

            .form-container .form-control {
                font-size: 0.95rem;
            }

            .form-container .status-options {
                grid-template-columns: 1fr;
                gap: 6px;
            }
        }

        @media (max-width: 400px) {
            .form-container {
                padding: 15px;
            }

            .form-container .form-header h3 {
                font-size: 1rem;
            }

            .form-container .form-label {
                font-size: 0.8rem;
            }
        }
    </style>

    <div class="form-container">
        <div class="form-header">
            <h3>
                <i class="fas fa-user-edit"></i>
                Modifier Prospect
            </h3>
            <span class="edit-badge">
                <i class="fas fa-pen"></i> Édition
            </span>
        </div>

        <form method="POST" action="{{ route('prospecteur.prospects.update', $prospect) }}">
            @csrf @method('PUT')

            <!-- Projet -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-project-diagram"></i>
                    Projet
                    <span class="required">*</span>
                </label>
                <select name="project_id" class="form-control @error('project_id') is-invalid @enderror" required>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ old('project_id', $prospect->project_id) == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Nom -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    Nom du prospect
                    <span class="required">*</span>
                </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $prospect->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Téléphone -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-phone"></i>
                    Téléphone
                </label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $prospect->phone) }}" placeholder="06 12 34 56 78">
                @error('phone')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-envelope"></i>
                    Email
                </label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $prospect->email) }}" placeholder="jean.dupont@email.com">
                @error('email')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-sticky-note"></i>
                    Notes
                </label>
                <textarea name="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Informations complémentaires...">{{ old('notes', $prospect->notes) }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Statut -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-tag"></i>
                    Statut
                    <span class="required">*</span>
                    @php
                        $statusLabels = [
                            'en_cours' => 'En cours',
                            'vendu' => 'Vendu',
                            'non_vendu' => 'Non vendu'
                        ];
                        $statusClasses = [
                            'en_cours' => 'en_cours',
                            'vendu' => 'vendu',
                            'non_vendu' => 'non_vendu'
                        ];
                    @endphp
                    <span class="current-status {{ $statusClasses[$prospect->status] ?? 'en_cours' }}">
                        <i class="fas {{ $prospect->status == 'vendu' ? 'fa-check-circle' : ($prospect->status == 'non_vendu' ? 'fa-times-circle' : 'fa-clock') }}"></i>
                        {{ $statusLabels[$prospect->status] ?? 'En cours' }}
                    </span>
                </label>

                <div class="status-options">
                    <div class="status-option">
                        <input type="radio" name="status" id="status_en_cours" value="en_cours" {{ old('status', $prospect->status) == 'en_cours' ? 'checked' : '' }}>
                        <label for="status_en_cours">
                            <i class="fas fa-clock status-en-cours"></i>
                            En cours
                        </label>
                    </div>
                    <div class="status-option">
                        <input type="radio" name="status" id="status_vendu" value="vendu" {{ old('status', $prospect->status) == 'vendu' ? 'checked' : '' }}>
                        <label for="status_vendu">
                            <i class="fas fa-check-circle status-vendu"></i>
                            Vendu
                        </label>
                    </div>
                    <div class="status-option">
                        <input type="radio" name="status" id="status_non_vendu" value="non_vendu" {{ old('status', $prospect->status) == 'non_vendu' ? 'checked' : '' }}>
                        <label for="status_non_vendu">
                            <i class="fas fa-times-circle status-non-vendu"></i>
                            Non vendu
                        </label>
                    </div>
                </div>
                @error('status')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Actions -->
            <div class="btn-group-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-sync-alt"></i> Mettre à jour
                </button>
                <a href="{{ route('prospecteur.prospects.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection