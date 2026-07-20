<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - FDK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #0d1f3c 0%, #1a3a6a 50%, #0d1f3c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Background animated circles */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 30% 40%, rgba(255, 215, 0, 0.03) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 60%, rgba(0, 100, 255, 0.04) 0%, transparent 60%);
            animation: rotateBg 40s linear infinite;
            pointer-events: none;
        }

        @keyframes rotateBg {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: none;
            border-radius: 24px;
            padding: 40px 35px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(255, 215, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 80px rgba(0, 0, 0, 0.6), 0 0 60px rgba(255, 215, 0, 0.08);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #1a3a6a, #ffd700);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
            border-radius: 24px 24px 0 0;
        }

        @keyframes shimmer {
            0%, 100% { background-position: -200% 0; }
            50% { background-position: 200% 0; }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo-section .logo-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            box-shadow: 0 8px 25px rgba(13, 31, 60, 0.25);
        }

        .logo-section .logo-icon i {
            font-size: 2rem;
            color: #ffd700;
        }

        .logo-section h4 {
            font-weight: 700;
            color: #0d1f3c;
            margin: 0;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .logo-section h4 span {
            color: #ffd700;
        }

        .logo-section .subtitle {
            color: #6c757d;
            font-size: 0.85rem;
            margin: 4px 0 0;
            letter-spacing: 2px;
        }

        .logo-section .subtitle i {
            color: #ffd700;
            margin-right: 4px;
        }

        .form-label {
            font-weight: 600;
            color: #0d1f3c;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 6px;
        }

        .form-label i {
            color: #ffd700;
            width: 18px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom .form-control {
            border-radius: 12px;
            border: 2px solid #e0e7f0;
            padding: 12px 16px 12px 44px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            background: #f8f9fa;
        }

        .input-group-custom .form-control:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.12);
            background: white;
        }

        .input-group-custom .form-control::placeholder {
            color: #adb5bd;
            font-size: 0.9rem;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            z-index: 10;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .input-group-custom:focus-within .input-icon {
            color: #ffd700;
        }

        .input-group-custom .toggle-password {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #adb5bd;
            cursor: pointer;
            padding: 0;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .input-group-custom .toggle-password:hover {
            color: #0d1f3c;
        }

        .btn-login {
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 6px;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(13, 31, 60, 0.35);
            color: white;
        }

        .btn-login i {
            color: #ffd700;
            font-size: 0.9rem;
        }

        .btn-login:hover i {
            transform: translateX(4px);
            transition: transform 0.3s ease;
        }

        .alert {
            border-radius: 12px;
            border: none;
            font-size: 0.9rem;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .alert-danger i {
            color: #dc2626;
            font-size: 1.1rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 2px solid #f0f2f6;
        }

        .footer-links a {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .footer-links a i {
            color: #ffd700;
            font-size: 0.8rem;
        }

        .footer-links a:hover {
            color: #0d1f3c;
        }

        .footer-links a:hover i {
            transform: translateX(2px);
            transition: transform 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .card {
                padding: 30px 22px;
                border-radius: 20px;
            }

            .logo-section h4 {
                font-size: 1.3rem;
            }

            .logo-section .logo-icon {
                width: 54px;
                height: 54px;
            }

            .logo-section .logo-icon i {
                font-size: 1.6rem;
            }

            .input-group-custom .form-control {
                padding: 10px 14px 10px 40px;
                font-size: 0.9rem;
            }

            .btn-login {
                padding: 12px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 400px) {
            .card {
                padding: 24px 16px;
                border-radius: 16px;
            }

            .logo-section h4 {
                font-size: 1.1rem;
            }

            .logo-section .subtitle {
                font-size: 0.75rem;
            }

            .input-group-custom .form-control {
                padding: 8px 12px 8px 36px;
                font-size: 0.85rem;
                border-radius: 10px;
            }

            .input-group-custom .input-icon {
                left: 12px;
                font-size: 0.8rem;
            }

            .btn-login {
                padding: 10px;
                font-size: 0.85rem;
                border-radius: 10px;
            }

            .footer-links a {
                font-size: 0.75rem;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .card {
                padding: 45px 40px;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .card {
                background: rgba(20, 30, 50, 0.95);
            }

            .logo-section h4 {
                color: white;
            }

            .logo-section .subtitle {
                color: #a0aec0;
            }

            .form-label {
                color: #e2e8f0;
            }

            .input-group-custom .form-control {
                background: rgba(255, 255, 255, 0.06);
                border-color: rgba(255, 255, 255, 0.1);
                color: white;
            }

            .input-group-custom .form-control:focus {
                background: rgba(255, 255, 255, 0.08);
                border-color: #ffd700;
            }

            .input-group-custom .form-control::placeholder {
                color: rgba(255, 255, 255, 0.3);
            }

            .input-group-custom .input-icon {
                color: rgba(255, 255, 255, 0.3);
            }

            .input-group-custom .toggle-password {
                color: rgba(255, 255, 255, 0.3);
            }

            .input-group-custom .toggle-password:hover {
                color: #ffd700;
            }

            .footer-links {
                border-top-color: rgba(255, 255, 255, 0.06);
            }

            .footer-links a {
                color: #a0aec0;
            }

            .footer-links a:hover {
                color: #ffd700;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="card">
            <!-- Logo & Title -->
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-cubes"></i>
                </div>
                <h4>FDK <span>ERP</span></h4>
                <p class="subtitle">
                    <i class="fas fa-user-tie"></i> Espace Prospecteur
                </p>
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
                    <div class="input-group-custom">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" class="form-control" placeholder="votre@email.com" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-lock"></i> Mot de passe
                    </label>
                    <div class="input-group-custom">
                        <i class="fas fa-key input-icon"></i>
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

            <!-- Footer Link -->
            <div class="footer-links">
                <a href="{{ route('admin.login') }}">
                    <i class="fas fa-user-shield"></i> Accès Admin
                </a>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
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