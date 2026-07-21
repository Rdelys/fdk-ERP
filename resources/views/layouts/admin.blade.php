<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - FDK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="{{ asset('css/admin-theme.css') }}" rel="stylesheet">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-chart-line"></i> FDK ERP
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i> Projets
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Users (Prospecteurs)
                </a>
            </li>
            <li>
                <a href="{{ route('admin.finance.index') }}" class="nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}">
                    <i class="fas fa-wallet"></i> Finance
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="btn btn-sm w-100"><i class="fas fa-sign-out-alt me-1"></i> Déconnexion</button>
            </form>
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="topbar">
            <div>
                <h4>@yield('page-title', 'Dashboard')</h4>
                <p>@yield('page-subtitle', 'Bienvenue sur votre espace admin')</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <i class="fas fa-bell text-muted"></i>
                <div class="avatar-circle">AD</div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert-box alert-success-box mb-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

</body>
</html>