<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - FDK ERP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f6;
            padding: 20px;
            -webkit-font-smoothing: antialiased;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        /* Header */
        .email-header {
            background: linear-gradient(135deg, #0d1f3c 0%, #1a3a6a 100%);
            padding: 35px 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 30% 40%, rgba(255, 215, 0, 0.05) 0%, transparent 60%);
            animation: rotateBg 30s linear infinite;
        }

        @keyframes rotateBg {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .email-header .logo-icon {
            width: 64px;
            height: 64px;
            background: rgba(255, 215, 0, 0.15);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            border: 2px solid rgba(255, 215, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .email-header .logo-icon i {
            font-size: 2rem;
            color: #ffd700;
        }

        .email-header h1 {
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .email-header h1 span {
            color: #ffd700;
        }

        .email-header .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-top: 4px;
            position: relative;
            z-index: 1;
            letter-spacing: 2px;
        }

        .email-header .subtitle i {
            color: #ffd700;
            margin-right: 4px;
        }

        /* Content */
        .email-body {
            padding: 35px 40px;
        }

        .email-body .greeting {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .email-body .greeting i {
            color: #ffd700;
        }

        .email-body .intro {
            color: #4a5568;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* Credentials Box */
        .credentials-box {
            background: #f8f9ff;
            border-radius: 16px;
            padding: 25px 30px;
            margin-bottom: 25px;
            border: 2px solid #eef0f5;
            position: relative;
        }

        .credentials-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffd700, #1a3a6a);
            border-radius: 16px 16px 0 0;
        }

        .credentials-box .box-title {
            font-weight: 700;
            color: #0d1f3c;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .credentials-box .box-title i {
            color: #ffd700;
        }

        .credentials-box .cred-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eef0f5;
        }

        .credentials-box .cred-item:last-child {
            border-bottom: none;
        }

        .credentials-box .cred-item .label {
            font-weight: 600;
            color: #0d1f3c;
            min-width: 100px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .credentials-box .cred-item .label i {
            color: #ffd700;
            width: 18px;
        }

        .credentials-box .cred-item .value {
            color: #1a3a6a;
            font-weight: 600;
            font-size: 0.95rem;
            word-break: break-all;
        }

        .credentials-box .cred-item .value.password {
            background: rgba(255, 215, 0, 0.08);
            padding: 4px 12px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }

        /* Warning Box */
        .warning-box {
            background: #fffdf5;
            border-radius: 12px;
            padding: 16px 20px;
            border: 2px solid rgba(255, 215, 0, 0.2);
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 25px;
        }

        .warning-box i {
            color: #ffd700;
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .warning-box p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
        }

        .warning-box p strong {
            color: #0d1f3c;
        }

        /* Button */
        .btn-container {
            text-align: center;
            margin: 30px 0 10px;
        }

        .btn-login {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #0d1f3c, #1a3a6a);
            color: white;
            padding: 14px 40px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 31, 60, 0.2);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(13, 31, 60, 0.35);
            color: white;
        }

        .btn-login i {
            color: #ffd700;
        }

        .btn-login:hover i {
            transform: translateX(4px);
            transition: transform 0.3s ease;
        }

        /* Footer */
        .email-footer {
            background: #f8f9fa;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #eef0f5;
        }

        .email-footer p {
            margin: 0;
            color: #6c757d;
            font-size: 0.8rem;
        }

        .email-footer p i {
            color: #ffd700;
            margin: 0 4px;
        }

        .email-footer .footer-links {
            margin-top: 8px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .email-footer .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            font-size: 0.75rem;
            transition: color 0.3s ease;
        }

        .email-footer .footer-links a:hover {
            color: #1a3a6a;
        }

        .email-footer .footer-links a i {
            color: #ffd700;
            margin-right: 4px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .email-wrapper {
                border-radius: 12px;
            }

            .email-header {
                padding: 25px 20px;
            }

            .email-header h1 {
                font-size: 1.4rem;
            }

            .email-header .logo-icon {
                width: 50px;
                height: 50px;
            }

            .email-header .logo-icon i {
                font-size: 1.5rem;
            }

            .email-body {
                padding: 25px 20px;
            }

            .email-body .greeting {
                font-size: 1.2rem;
            }

            .credentials-box {
                padding: 20px;
            }

            .credentials-box .cred-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
                padding: 12px 0;
            }

            .credentials-box .cred-item .label {
                min-width: auto;
                font-size: 0.8rem;
            }

            .credentials-box .cred-item .value {
                font-size: 0.9rem;
                word-break: break-all;
            }

            .btn-login {
                padding: 12px 30px;
                font-size: 0.9rem;
                width: 100%;
                justify-content: center;
            }

            .email-footer {
                padding: 15px 20px;
            }

            .email-footer .footer-links {
                flex-direction: column;
                gap: 6px;
            }
        }

        @media (max-width: 400px) {
            .email-body {
                padding: 20px 15px;
            }

            .email-body .greeting {
                font-size: 1rem;
            }

            .email-body .intro {
                font-size: 0.9rem;
            }

            .credentials-box {
                padding: 16px;
                border-radius: 12px;
            }

            .credentials-box .cred-item .value {
                font-size: 0.85rem;
            }

            .warning-box {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }

        /* Dark mode support for email clients */
        @media (prefers-color-scheme: dark) {
            .email-wrapper {
                background: #1a2332;
            }

            .email-body {
                background: #1a2332;
            }

            .email-body .greeting {
                color: white;
            }

            .email-body .intro {
                color: #a0aec0;
            }

            .credentials-box {
                background: rgba(255, 255, 255, 0.04);
                border-color: rgba(255, 255, 255, 0.06);
            }

            .credentials-box .box-title {
                color: #e2e8f0;
            }

            .credentials-box .cred-item {
                border-bottom-color: rgba(255, 255, 255, 0.06);
            }

            .credentials-box .cred-item .label {
                color: #e2e8f0;
            }

            .credentials-box .cred-item .value {
                color: #ffd700;
            }

            .warning-box {
                background: rgba(255, 215, 0, 0.04);
                border-color: rgba(255, 215, 0, 0.1);
            }

            .warning-box p {
                color: #a0aec0;
            }

            .warning-box p strong {
                color: white;
            }

            .email-footer {
                background: rgba(255, 255, 255, 0.02);
                border-top-color: rgba(255, 255, 255, 0.06);
            }

            .email-footer p {
                color: #6c757d;
            }

            .email-footer .footer-links a {
                color: #6c757d;
            }

            .email-footer .footer-links a:hover {
                color: #ffd700;
            }
        }
    </style>
</head>
<body>

    <div class="email-wrapper">

        <!-- Header -->
        <div class="email-header">
            <div class="logo-icon">
                <i class="fas fa-cubes"></i>
            </div>
            <h1>FDK <span>ERP</span></h1>
            <div class="subtitle">
                <i class="fas fa-user-check"></i> Bienvenue dans votre espace prospecteur
            </div>
        </div>

        <!-- Body -->
        <div class="email-body">

            <div class="greeting">
                <i class="fas fa-hand-wave"></i> Bonjour {{ $user->name }}
            </div>

            <p class="intro">
                Votre compte prospecteur a été créé avec succès sur la plateforme <strong>FDK ERP</strong>.
                Voici vos identifiants de connexion :
            </p>

            <!-- Credentials -->
            <div class="credentials-box">
                <div class="box-title">
                    <i class="fas fa-id-card"></i> Vos identifiants
                </div>

                <div class="cred-item">
                    <span class="label">
                        <i class="fas fa-envelope"></i> Email
                    </span>
                    <span class="value">{{ $user->email }}</span>
                </div>

                <div class="cred-item">
                    <span class="label">
                        <i class="fas fa-key"></i> Mot de passe
                    </span>
                    <span class="value password">{{ $password }}</span>
                </div>
            </div>

            <!-- Warning -->
            <div class="warning-box">
                <i class="fas fa-shield-alt"></i>
                <p>
                    <strong>🔐 Sécurité :</strong>
                    Nous vous recommandons vivement de changer votre mot de passe après votre première connexion.
                </p>
            </div>

            <!-- Login Button -->
            <div class="btn-container">
                <a href="{{ url('/') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </a>
            </div>

        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>
                <i class="fas fa-copyright"></i> {{ date('Y') }} FDK ERP — Tous droits réservés
            </p>
            <div class="footer-links">
                <a href="{{ url('/') }}">
                    <i class="fas fa-globe"></i> Accéder à la plateforme
                </a>
                <a href="mailto:support@fdk-erp.com">
                    <i class="fas fa-headset"></i> Support
                </a>
            </div>
        </div>

    </div>

</body>
</html>