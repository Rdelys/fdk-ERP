<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FDK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0d1f3c 0%, #1a3a6a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            background: white;
            width: 100%;
            max-width: 400px;
        }

        .card-header {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            border-radius: 16px 16px 0 0 !important;
            padding: 25px 30px;
            border: none;
            text-align: center;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .card-header h4 i {
            color: #ffd700;
            margin-right: 8px;
        }

        .card-header small {
            display: block;
            color: #ffd700;
            font-weight: 300;
            letter-spacing: 3px;
            font-size: 0.75rem;
            margin-top: 4px;
        }

        .card-header small i {
            margin-right: 4px;
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #1a3a6a;
            font-size: 0.9rem;
        }

        .form-label i {
            color: #ffd700;
            margin-right: 6px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e0e7f0;
            padding: 12px 16px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.2s;
            width: 100%;
        }

        .btn-primary i {
            margin-right: 8px;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1a3a6a, #0d1f3c);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 31, 60, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
            border: none;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
        }

        .alert i {
            margin-right: 8px;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e0e7f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #1a3a6a;
        }

        .input-group-text i {
            color: #ffd700;
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }

        .input-group .form-control:focus {
            border-color: #ffd700;
        }

        .input-group:focus-within .input-group-text {
            border-color: #ffd700;
            background: #fff8e1;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .card-body {
                padding: 20px;
            }
            
            .card-header {
                padding: 20px;
            }
            
            .card-header h4 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-lock"></i> Accès Admin</h4>
            <small><i class="fas fa-cog"></i> FDK ERP</small>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-key"></i> Code d'accès
                    </label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="code" class="form-control" placeholder="Entrez votre code" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>