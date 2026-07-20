@extends('layouts.admin')

@section('page-title', 'Créer un projet')
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

        .form-container .form-header .step-badge {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-left: auto;
        }

        .form-container .form-header .step-badge i {
            color: #ffd700;
            margin-right: 4px;
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

        /* Error states */
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

            .form-container .form-header .step-badge {
                margin-left: 0;
                width: 100%;
                text-align: center;
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
        <!-- Header -->
        <div class="form-header">
            <h3>
                <i class="fas fa-plus-circle"></i>
                Nouveau Projet
            </h3>
            <span class="step-badge">
                <i class="fas fa-file-signature"></i> Formulaire
            </span>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nom -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-tag"></i>
                    Nom du projet
                    <span class="required">*</span>
                </label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Ex: Site vitrine FDK" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-align-left"></i>
                    Description
                </label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Décrivez le projet en quelques lignes...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle"></i> Une description claire aide à la compréhension du projet
                </div>
            </div>

            <!-- Prix -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-euro-sign"></i>
                    Prix
                </label>
                <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle"></i> Laissez vide si le prix n'est pas défini
                </div>
            </div>

            <!-- Guide PDF -->
            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-file-pdf"></i>
                    Guide PDF
                </label>
                <div class="file-input-wrapper">
                    <input type="file" name="guide_pdf" class="form-control @error('guide_pdf') is-invalid @enderror" accept="application/pdf">
                </div>
                @error('guide_pdf')
                    <div class="invalid-feedback">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
                <div class="form-text">
                    <i class="fas fa-info-circle"></i> Format accepté : PDF (max. 10 Mo)
                </div>
            </div>

            <!-- Actions -->
            <div class="btn-group-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>
        </form>
    </div>
@endsection