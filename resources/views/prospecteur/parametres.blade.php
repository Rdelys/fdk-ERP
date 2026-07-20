@extends('layouts.prospecteur')

@section('page-title', 'Mes paramètres')
@section('user-info', 'Prospecteur')

@section('content')
    <style>
        .settings-container {
            max-width: 650px;
        }

        .settings-card {
            background: white;
            border-radius: 16px;
            padding: 30px 35px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            border: 1px solid #eef0f5;
        }

        .settings-card .settings-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f2f6;
        }

        .settings-card .settings-header h3 {
            margin: 0;
            font-weight: 700;
            color: #0d1f3c;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .settings-card .settings-header h3 i {
            color: #ffd700;
        }

        .settings-card .settings-header .badge-profile {
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

        .settings-card .settings-header .badge-profile i {
            color: #ffd700;
        }

        .settings-card .form-label {
            font-weight: 600;
            color: #0d1f3c;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .settings-card .form-label i {
            color: #ffd700;
            width: 18px;
        }

        .settings-card .form-label .required {
            color: #dc3545;
            font-weight: 700;
        }

        .settings-card .form-control {
            border-radius: 10px;
            border: 2px solid #e0e7f0;
            padding: 10px 16px;
            transition: all 0.2s ease;
        }

        .settings-card .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.15);
        }

        .settings-card .form-control::placeholder {
            color: #adb5bd;
            font-size: 0.9rem;
        }

        .settings-card .divider {
            border: none;
            border-top: 2px solid #f0f2f6;
            margin: 25px 0 20px;
        }

        .settings-card .info-text {
            color: #6c757d;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
        }

        .settings-card .info-text i {
            color: #ffd700;
        }

        .settings-card .password-hint {
            background: #f8f9ff;
            border-radius: 8px;
            padding: 10px 14px;
            margin-top: 4px;
            font-size: 0.8rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .settings-card .password-hint i {
            color: #ffd700;
        }

        .settings-card .btn-group-actions {
            display: flex;
            gap: 12px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #f0f2f6;
            flex-wrap: wrap;
        }

        .settings-card .btn-group-actions .btn-submit {
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

        .settings-card .btn-group-actions .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 31, 60, 0.3);
        }

        .settings-card .btn-group-actions .btn-submit i {
            color: #ffd700;
        }

        .settings-card .btn-group-actions .btn-cancel {
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

        .settings-card .btn-group-actions .btn-cancel:hover {
            background: #e9ecef;
            border-color: #ced4da;
            color: #495057;
            text-decoration: none;
        }

        .settings-card .btn-group-actions .btn-cancel i {
            color: #6c757d;
        }

        .settings-card .is-invalid {
            border-color: #dc3545;
        }

        .settings-card .is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
        }

        .settings-card .invalid-feedback {
            font-size: 0.8rem;
            color: #dc3545;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 4px;
        }

        .settings-card .invalid-feedback i {
            font-size: 0.7rem;
        }

        .settings-card .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .settings-card .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .settings-card .alert-danger i {
            margin-right: 8px;
            color: #dc2626;
        }

        .settings-card .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .settings-card .alert-danger ul li {
            margin: 2px 0;
        }

        @media (max-width: 576px) {
            .settings-card {
                padding: 20px;
                border-radius: 12px;
            }

            .settings-card .settings-header {
                flex-wrap: wrap;
            }

            .settings-card .settings-header .badge-profile {
                margin-left: 0;
                width: 100%;
                justify-content: center;
            }

            .settings-card .settings-header h3 {
                font-size: 1.2rem;
            }

            .settings-card .btn-group-actions {
                flex-direction: column;
            }

            .settings-card .btn-group-actions .btn-submit,
            .settings-card .btn-group-actions .btn-cancel {
                justify-content: center;
                width: 100%;
            }

            .settings-card .form-control {
                font-size: 0.95rem;
            }

            .settings-card .info-text {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 400px) {
            .settings-card {
                padding: 15px;
            }

            .settings-card .settings-header h3 {
                font-size: 1rem;
            }

            .settings-card .form-label {
                font-size: 0.8rem;
            }
        }
    </style>

    <div class="settings-container">
        <div class="settings-card">
            <!-- Header -->
            <div class="settings-header">
                <h3>
                    <i class="fas fa-user-cog"></i>
                    Mes Paramètres
                </h3>
                <span class="badge-profile">
                    <i class="fas fa-user-edit"></i> Édition
                </span>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('prospecteur.parametres.update') }}">
                @csrf

                <!-- Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Informations personnelles -->
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Nom complet
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" placeholder="Votre nom complet" required>
                    @error('name')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-envelope"></i>
                        Email
                        <span class="required">*</span>
                    </label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="votre@email.com" required>
                    @error('email')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-phone"></i>
                        Téléphone
                    </label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="06 12 34 56 78">
                    @error('phone')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <hr class="divider">

                <!-- Changement de mot de passe -->
                <div class="info-text">
                    <i class="fas fa-info-circle"></i>
                    Laissez vide si vous ne voulez pas changer le mot de passe
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-key"></i>
                        Nouveau mot de passe
                    </label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                    @error('password')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                    <div class="password-hint">
                        <i class="fas fa-shield-alt"></i>
                        Minimum 8 caractères pour une sécurité optimale
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-check-circle"></i>
                        Confirmer le mot de passe
                    </label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe">
                </div>

                <!-- Actions -->
                <div class="btn-group-actions">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('prospecteur.dashboard') }}" class="btn-cancel">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection