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
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            padding: 35px 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            border-top: 4px solid #ffd700;
        }

        .login-card .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-card .logo i {
            font-size: 2.5rem;
            color: #ffd700;
            background: #0d1f3c;
            padding: 15px;
            border-radius: 12px;
        }

        .login-card .logo h4 {
            font-weight: 700;
            color: #0d1f3c;
            margin: 12px 0 4px;
        }

        .login-card .logo h4 span {
            color: #ffd700;
        }

        .login-card .logo p {
            color: #6c757d;
            font-size: 0.85rem;
            margin: 0;
        }

        .login-card .form-label {
            font-weight: 600;
            color: #0d1f3c;
            font-size: 0.85rem;
        }

        .login-card .form-label i {
            color: #ffd700;
            margin-right: 6px;
        }

        .login-card .form-control {
            border-radius: 10px;
            border: 2px solid #e0e7f0;
            padding: 10px 14px;
            transition: all 0.2s ease;
        }

        .login-card .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.15);
        }

        .login-card .input-group .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e0e7f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #ffd700;
        }

        .login-card .input-group .form-control {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }

        .login-card .input-group .form-control:focus {
            border-color: #ffd700;
        }

        .login-card .input-group:focus-within .input-group-text {
            border-color: #ffd700;
            background: #fffdf5;
        }

        .login-card .btn-login {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            width: 100%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-card .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 31, 60, 0.3);
        }

        .login-card .btn-login i {
            color: #ffd700;
        }

        .login-card .alert {
            border-radius: 10px;
            font-size: 0.9rem;
            border: none;
            padding: 12px 16px;
        }

        .login-card .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .login-card .alert-danger i {
            margin-right: 8px;
        }

        .login-card .footer-link {
            text-align: center;
            margin-top: 18px;
            padding-top: 15px;
            border-top: 2px solid #f0f2f6;
        }

        .login-card .footer-link a {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s ease;
        }

        .login-card .footer-link a i {
            color: #ffd700;
            margin-right: 4px;
        }

        .login-card .footer-link a:hover {
            color: #0d1f3c;
        }

        .login-card .toggle-password {
            background: none;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            padding: 0 12px;
        }

        .login-card .toggle-password:hover {
            color: #0d1f3c;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 25px 20px;
            }

            .login-card .logo i {
                font-size: 2rem;
                padding: 12px;
            }

            .login-card .logo h4 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Logo -->
        <div class="logo">
            <i class="fas fa-cubes"></i>
            <h4>FDK <span>ERP</span></h4>
            <p>Espace Prospecteur</p>
        </div>

        <!-- Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-envelope"></i> Email
                </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="votre@email.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    <i class="fas fa-lock"></i> Mot de passe
                </label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>
        </form>

        <!-- Footer -->
        <div class="footer-link">
            <a href="{{ route('admin.login') }}">
                <i class="fas fa-user-shield"></i> Accès Admin
            </a>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>

</body>
</html>