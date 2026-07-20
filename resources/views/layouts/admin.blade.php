<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - FDK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white vh-100 p-3" style="width: 220px; position: fixed;">
            <h5 class="mb-4">FDK ERP - Admin</h5>
            <ul class="nav nav-pills flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.projects.index') }}" class="nav-link text-white {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">Projets</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link text-white {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users (Prospecteurs)</a>
                </li>
            </ul>
            <form method="POST" action="{{ route('admin.logout') }}" class="mt-4">
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