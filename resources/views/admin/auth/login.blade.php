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
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            background: #fff;
            width: 100%;
            max-width: 400px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: #fff;
            padding: 32px 30px;
            border: none;
            text-align: center;
        }

        .card-header .icon-circle {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 1.5rem;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .card-header small {
            display: block;
            color: #bfdbfe;
            font-weight: 400;
            letter-spacing: 2px;
            font-size: 0.72rem;
            margin-top: 6px;
            text-transform: uppercase;
        }

        .card-body { padding: 32px 30px; }

        .form-label { font-weight: 600; color: #1e293b; font-size: 0.85rem; }

        .input-group-text {
            background: #f4f7fe;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #3b82f6;
        }

        .input-group .form-control {
            border: 1.5px solid #e2e8f0;
            border-left: none;
            border-radius: 0 10px 10px 0;
            padding: 12px;
        }

        .input-group .form-control:focus {
            box-shadow: none;
            border-color: #3b82f6;
        }

        .input-group:focus-within .input-group-text {
            border-color: #3b82f6;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-weight: 600;
            color: #fff;
            width: 100%;
            transition: all 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
            color: #fff;
        }

        .alert-danger {
            border-radius: 10px;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="icon-circle"><i class="fas fa-shield-alt"></i></div>
            <h4>Accès Admin</h4>
            <small>FDK ERP</small>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Code d'accès</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="code" class="form-control" placeholder="••••" required autofocus>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>
            </form>
        </div>
    </div>
</body>
</html>