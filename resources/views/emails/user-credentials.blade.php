<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue - FDK ERP</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7fe;
            padding: 20px;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        .email-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 35px 40px 30px;
            text-align: center;
        }

        .email-header .logo-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.15);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .email-header .logo-icon span { font-size: 1.8rem; }

        .email-header h1 {
            color: white;
            font-weight: 700;
            font-size: 1.6rem;
            margin: 0;
        }

        .email-header .subtitle {
            color: #bfdbfe;
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .email-body { padding: 35px 40px; }

        .email-body .greeting {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .email-body .intro {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .credentials-box {
            background: #f4f7fe;
            border-radius: 14px;
            padding: 24px 28px;
            margin-bottom: 22px;
            border: 1px solid #e2e8f0;
            border-top: 3px solid #3b82f6;
        }

        .credentials-box .box-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 14px;
        }

        .credentials-box .cred-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .credentials-box .cred-item:last-child { border-bottom: none; }

        .credentials-box .cred-item .label {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.88rem;
        }

        .credentials-box .cred-item .value {
            color: #3b82f6;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .credentials-box .cred-item .value.password {
            background: #dbeafe;
            padding: 4px 12px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }

        .warning-box {
            background: #fefce8;
            border-radius: 12px;
            padding: 14px 18px;
            border-left: 4px solid #f59e0b;
            margin-bottom: 25px;
        }

        .warning-box p {
            margin: 0;
            color: #78716c;
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .warning-box p strong { color: #1e293b; }

        .btn-container { text-align: center; margin: 26px 0 6px; }

        .btn-login {
            display: inline-block;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            padding: 13px 38px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .email-footer {
            background: #f8fafc;
            padding: 18px 40px;
            text-align: center;
            border-top: 1px solid #eef2f7;
        }

        .email-footer p {
            margin: 0;
            color: #94a3b8;
            font-size: 0.78rem;
        }
    </style>
</head>
<body>

    <div class="email-wrapper">
        <div class="email-header">
            <div class="logo-icon"><span>📊</span></div>
            <h1>FDK ERP</h1>
            <div class="subtitle">Bienvenue dans votre espace prospecteur</div>
        </div>

        <div class="email-body">
            <div class="greeting">Bonjour {{ $user->name }} 👋</div>

            <p class="intro">
                Votre compte prospecteur a été créé avec succès sur la plateforme <strong>FDK ERP</strong>.
                Voici vos identifiants de connexion :
            </p>

            <div class="credentials-box">
                <div class="box-title">Vos identifiants</div>
                <div class="cred-item">
                    <span class="label">Email</span>
                    <span class="value">{{ $user->email }}</span>
                </div>
                <div class="cred-item">
                    <span class="label">Mot de passe</span>
                    <span class="value password">{{ $password }}</span>
                </div>
            </div>

            <div class="warning-box">
                <p><strong>Sécurité :</strong> Nous vous recommandons de changer votre mot de passe après votre première connexion, dans la section Paramètres.</p>
            </div>

            <div class="btn-container">
                <a href="{{ url('/') }}" class="btn-login">Se connecter →</a>
            </div>
        </div>

        <div class="email-footer">
            <p>© {{ date('Y') }} FDK ERP — Tous droits réservés</p>
        </div>
    </div>

</body>
</html>