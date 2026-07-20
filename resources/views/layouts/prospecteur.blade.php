<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FDK ERP - Espace Prospecteur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-primary text-white vh-100 p-3" style="width: 220px; position: fixed;">
            <h5 class="mb-4">FDK ERP</h5>
            <ul class="nav nav-pills flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('prospecteur.dashboard') }}" class="nav-link text-white {{ request()->routeIs('prospecteur.dashboard') ? 'active' : '' }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prospecteur.prospects.index') }}" class="nav-link text-white {{ request()->routeIs('prospecteur.prospects.*') ? 'active' : '' }}">Prospects</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prospecteur.projets') }}" class="nav-link text-white {{ request()->routeIs('prospecteur.projets') ? 'active' : '' }}">Projets</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('prospecteur.parametres') }}" class="nav-link text-white {{ request()->routeIs('prospecteur.parametres') ? 'active' : '' }}">Paramètres</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button class="btn btn-outline-light btn-sm w-100">Déconnexion</button>
            </form>
        </div>

        <!-- Content -->
        <div class="p-4" style="margin-left: 220px; width: 100%;">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>