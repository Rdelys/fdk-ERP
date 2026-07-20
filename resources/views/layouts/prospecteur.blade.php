<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FDK ERP - Espace Prospecteur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f0f2f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #0d1f3c 0%, #1a3a6a 100%);
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 20px;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
            box-shadow: 4px 0 20px rgba(0,0,0,0.2);
        }

        .sidebar-brand {
            color: white;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(255, 215, 0, 0.2);
            margin-bottom: 25px;
        }

        .sidebar-brand h5 {
            font-weight: 700;
            font-size: 1.2rem;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .sidebar-brand h5 i {
            color: #ffd700;
        }

        .sidebar-brand small {
            display: block;
            color: #ffd700;
            font-size: 0.65rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 4px;
            opacity: 0.8;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 16px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .nav-link i {
            width: 20px;
            color: #ffd700;
            font-size: 1rem;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 215, 0, 0.1);
            color: white;
            transform: translateX(4px);
        }

        .sidebar .nav-link.active {
            background: rgba(255, 215, 0, 0.15);
            color: #ffd700;
            border: 1px solid rgba(255, 215, 0, 0.2);
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.1);
        }

        .sidebar .nav-link.active i {
            color: #ffd700;
        }

        .sidebar .logout-btn {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid rgba(255, 215, 0, 0.15);
        }

        .sidebar .logout-btn .btn {
            color: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .sidebar .logout-btn .btn:hover {
            background: rgba(255, 215, 0, 0.15);
            border-color: #ffd700;
            color: white;
            transform: translateY(-2px);
        }

        .sidebar .logout-btn .btn i {
            margin-right: 8px;
        }

        /* Content */
        .main-content {
            margin-left: 250px;
            padding: 25px 30px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .main-content .top-bar {
            background: white;
            border-radius: 15px;
            padding: 18px 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .main-content .top-bar h4 {
            margin: 0;
            color: #0d1f3c;
            font-weight: 700;
        }

        .main-content .top-bar h4 i {
            color: #ffd700;
            margin-right: 10px;
        }

        .main-content .top-bar .user-info {
            color: #6c757d;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .main-content .top-bar .user-info i {
            color: #ffd700;
        }

        .main-content .top-bar .user-info .user-badge {
            background: rgba(255, 215, 0, 0.12);
            color: #d4a800;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-success i {
            margin-right: 8px;
            color: #28a745;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert-danger i {
            margin-right: 8px;
            color: #dc3545;
        }

        /* Content area */
        .content-area {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            min-height: 400px;
        }

        /* Toggle button for mobile */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            background: #0d1f3c;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 15px;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: #1a3a6a;
            transform: scale(1.05);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
                padding: 20px 15px;
                padding-top: 70px;
            }

            .main-content .top-bar {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                width: 280px;
                padding: 20px 15px;
            }

            .sidebar .nav-link {
                padding: 10px 14px;
                font-size: 0.95rem;
            }

            .main-content {
                padding: 15px 10px;
                padding-top: 70px;
            }

            .main-content .top-bar {
                padding: 15px 18px;
            }

            .main-content .top-bar h4 {
                font-size: 1.1rem;
            }

            .content-area {
                padding: 15px;
                border-radius: 12px;
            }

            .alert {
                padding: 12px 15px;
                font-size: 0.9rem;
            }
        }

        /* Scrollbar styling */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: #ffd700;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Toggle Button (mobile) -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h5><i class="fas fa-cubes"></i> FDK ERP</h5>
            <small><i class="fas fa-user-tie"></i> Espace Prospecteur</small>
        </div>

        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('prospecteur.dashboard') }}" class="nav-link {{ request()->routeIs('prospecteur.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('prospecteur.prospects.index') }}" class="nav-link {{ request()->routeIs('prospecteur.prospects.*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i> Prospects
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('prospecteur.projets') }}" class="nav-link {{ request()->routeIs('prospecteur.projets') ? 'active' : '' }}">
                    <i class="fas fa-project-diagram"></i> Projets
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('prospecteur.parametres') }}" class="nav-link {{ request()->routeIs('prospecteur.parametres') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Paramètres
                </a>
            </li>
        </ul>

        <div class="logout-btn">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h4><i class="fas fa-chevron-right"></i> @yield('page-title', 'Tableau de bord')</h4>
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <span>@yield('user-info', 'Prospecteur')</span>
                <span class="user-badge">
                    <i class="fas fa-check-circle" style="color: #28a745;"></i> En ligne
                </span>
            </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Content -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('open');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const isClickInside = sidebar.contains(event.target) || toggle.contains(event.target);

            if (!isClickInside && window.innerWidth <= 992) {
                sidebar.classList.remove('open');
            }
        });

        // Close sidebar when a link is clicked (mobile)
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