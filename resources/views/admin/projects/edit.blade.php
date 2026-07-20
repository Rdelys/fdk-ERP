@extends('layouts.admin')

@section('page-title', 'Modifier le projet')
@section('user-info', 'Administrateur')

@section('content')
    <style>
        .form-container {
            background: white;
            border-radius: 16px;
            padding: 30px 35px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #eef0f5;
            max-width: 700px;
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

        .form-container .form-header .project-badge {
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

        .form-container .form-header .project-badge i {
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

        .form-container .form-text {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 4px;
        }

        .form-container .form-text i {
            color: #ffd700;
            margin-right: 4px;
        }

        .form-container .file-input-wrapper {
            position: relative;
        }

        .form-container .file-input-wrapper .form-control {
            padding: 8px 12px;
        }

        .form-container .file-input-wrapper .form-control::file-selector-button {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-right: 10px;
        }

        .form-container .file-input-wrapper .form-control::file-selector-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 31, 60, 0.25);
        }

        .form-container .current-pdf {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 8px 14px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #e0e7f0;
        }

        .form-container .current-pdf i {
            color: #dc3545;
            font-size: 1.1rem;
        }

        .form-container .current-pdf a {
            color: #1a3a6a;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-container .current-pdf a:hover {
            color: #0d1f3c;
            text-decoration: underline;
        }

        .form-container .current-pdf .file-size {
            color: #6c757d;
            font-size: 0.75rem;
            margin-left: auto;
        }

        .form-container .form-check {
            padding-left: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9ff;
            padding: 12px 18px;
            border-radius: 10px;
            border: 2px solid #eef0f5;
            transition: all 0.2s ease;
        }

        .form-container .form-check:hover {
            border-color: #ffd700;
            background: #fffdf5;
        }

        .form-container .form-check .form-check-input {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 2px solid #d0d5dd;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0;
        }

        .form-container .form-check .form-check-input:checked {
            background-color: #0d1f3c;
            border-color: #0d1f3c;
        }

        .form-container .form-check .form-check-label {
            font-weight: 600;
            color: #0d1f3c;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-container .form-check .form-check-label i {
            color: #ffd700;
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

        @media (max-width: 576px) {
            .form-container {
                padding: 20px;
                border-radius: 12px;
            }

            .form-container .form-header {
                flex-wrap: wrap;
            }

            .form-container .form-header .project-badge {
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

            .form-container .current-pdf {
                flex-wrap: wrap;
            }

            .form-container .current-pdf .file-size {
                margin-left: 0;
                width: 100%;
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
                <i class="fas fa-edit"></i>
                Modifier Projet
            </h3>
            <span class="project-badge">
                <i class="fas fa-pen"></i> Édition
            </span>
        </div>

        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-tag"></i>
                    Nom du projet
                    <span class="required">*</span>
                </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $project->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-align-left"></i>
                    Description
                </label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Décrivez le projet...">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle"></i> Une description claire aide à la compréhension du projet
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-euro-sign"></i>
                    Prix
                </label>
                <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price', $project->price) }}">
                @error('price')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle"></i> Laissez vide si le prix n'est pas défini
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-file-pdf"></i>
                    Guide PDF
                </label>
                @if ($project->guide_pdf)
                    <div class="current-pdf">
                        <i class="fas fa-file-pdf"></i>
                        <a href="{{ asset('storage/' . $project->guide_pdf) }}" target="_blank">
                            <i class="fas fa-eye"></i> Voir le PDF actuel
                        </a>
                        <span class="file-size">
                            <i class="fas fa-file"></i> PDF
                        </span>
                    </div>
                @endif
                <div class="file-input-wrapper">
                    <input type="file" name="guide_pdf" class="form-control @error('guide_pdf') is-invalid @enderror" accept="application/pdf">
                </div>
                @error('guide_pdf')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle"></i> Laissez vide pour conserver le fichier actuel
                </div>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    <i class="fas {{ $project->is_active ? 'fa-check-circle' : 'fa-circle' }}" style="color: {{ $project->is_active ? '#28a745' : '#6c757d' }};"></i>
                    Projet actif
                </label>
            </div>

            <div class="btn-group-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-sync-alt"></i> Mettre à jour
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection