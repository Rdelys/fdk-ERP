<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - FDK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h4 class="text-center mb-3">Accès Admin</h4>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

    <form method="POST" action="{{ route('admin.login.attempt') }}">
        @csrf
            <div class="mb-3">
                <label class="form-label">Code d'accès</label>
                <input type="password" name="code" class="form-control" placeholder="****" required autofocus>
            </div>
            <button type="submit" class="btn btn-dark w-100">Se connecter</button>
        </form>
    </div>
</body>
</html>