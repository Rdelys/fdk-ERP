<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - FDK ERP</title>
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

        .login-card {
            background: white;
            border-radius: 18px;
            padding: 35px 32px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
        }

        .login-card .logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-card .logo .icon-circle {
            width: 60px;
            height: 60px;
            background: #dbeafe;
            color: #3b82f6;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 12px;
        }

        .login-card .logo h4 {
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .login-card .logo p {
            color: #64748b;
            font-size: 0.85rem;
            margin: 2px 0 0;
        }

        .login-card .form-label {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.85rem;
        }

        .login-card .input-group-text {
            background: #f4f7fe;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #3b82f6;
        }

        .login-card .input-group .form-control {
            border: 1.5px solid #e2e8f0;
            border-left: none;
            border-radius: 0 10px 10px 0;
            padding: 11px;
        }

        .login-card .input-group .form-control:focus {
            box-shadow: none;
            border-color: #3b82f6;
        }

        .login-card .input-group:focus-within .input-group-text {
            border-color: #3b82f6;
        }

        .login-card .toggle-password {
            background: #f4f7fe;
            border: 1.5px solid #e2e8f0;
            border-left: none;
            color: #94a3b8;
            border-radius: 0 10px 10px 0;
            padding: 0 14px;
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
            border-left: 4px solid #dc2626;
        }

        .footer-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #eef2f7;
        }

        .footer-link a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .footer-link a:hover { color: #3b82f6; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo">
            <div class="icon-circle"><i class="fas fa-cubes"></i></div>
            <h4>FDK ERP</h4>
            <p>Espace Prospecteur</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="votre@email.com" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Se connecter
            </button>
        </form>

        <div class="footer-link">
            <a href="{{ route('admin.login') }}"><i class="fas fa-user-shield me-1"></i> Accès Admin</a>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = this.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>

</body>
</html>