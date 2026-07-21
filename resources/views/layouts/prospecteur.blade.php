<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Espace Prospecteur') - FDK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="{{ asset('css/admin-theme.css') }}" rel="stylesheet">
</head>
<body>

    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-cubes"></i> FDK ERP
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('prospecteur.dashboard') }}" class="nav-link {{ request()->routeIs('prospecteur.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('prospecteur.prospects.index') }}" class="nav-link {{ request()->routeIs('prospecteur.prospects.*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i> Prospects
                </a>
            </li>
            <li>
                <a href="{{ route('prospecteur.projets') }}" class="nav-link {{ request()->routeIs('prospecteur.projets') ? 'active' : '' }}">
                    <i class="fas fa-project-diagram"></i> Projets
                </a>
            </li>
            <li>
                <a href="{{ route('prospecteur.parametres') }}" class="nav-link {{ request()->routeIs('prospecteur.parametres') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Paramètres
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm w-100"><i class="fas fa-sign-out-alt me-1"></i> Déconnexion</button>
            </form>
        </div>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <div class="topbar">
            <div>
                <h4>@yield('page-title', 'Tableau de bord')</h4>
                <p>@yield('page-subtitle', 'Bienvenue sur votre espace')</p>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="badge-custom badge-vendu">
                    <i class="fas fa-circle" style="font-size: 6px;"></i> En ligne
                </span>
                <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name ?? 'PR', 0, 2)) }}</div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert-box alert-success-box mb-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-box alert-danger-box mb-4">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
        });

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const isClickInside = sidebar.contains(event.target) || toggle.contains(event.target);

            if (!isClickInside && window.innerWidth <= 992) {
                sidebar.classList.remove('open');
            }
        });

        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    document.getElementById('sidebar').classList.remove('open');
                }
            });
        });
    </script>

</body>
</html>