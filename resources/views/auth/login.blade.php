<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - FDK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h4 class="text-center mb-3">FDK ERP</h4>
        <p class="text-center text-muted small">Espace Prospecteur</p>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

    <form method="POST" action="{{ route('login.attempt') }}">
        @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('admin.login') }}" class="small text-muted">Accès Admin</a>
        </div>
    </div>
</body>
</html>