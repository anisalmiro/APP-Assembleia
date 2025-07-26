<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestao Assembleia')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.2);
        }
        .navbar-brand {
            font-weight: bold;
            color: #667eea !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">
                            <img src="{{ asset('imagens/Assembleia.jpg') }}" alt="Logo" style="height: 30px;" class="me-2">
                            <span>Sistema de Gestão do Patrimonio ASS. Deus Baixa
                        </h4>
                    </div>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}" href="{{ route('members.index') }}">
                                <i class="fas fa-users me-2"></i>
                                Membros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('assets.*') ? 'active' : '' }}" href="{{ route('assets.index') }}">
                                <i class="fas fa-boxes me-2"></i>
                                Patrimônio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('financial-transactions.*') ? 'active' : '' }}" href="{{ route('financial-transactions.index') }}">
                                <i class="fas fa-hand-holding-usd me-2"></i>
                                Dízimos & Doações
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}" href="{{ route('expenses.index') }}">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                Despesas
                            </a>
                        </li>

                        <hr class="my-3" style="border-color: rgba(255, 255, 255, 0.3);">

                        <li class="nav-item">
                            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                <span style="color: rgba(255, 255, 255, 0.6);">Relatórios</span>
                            </h6>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports.financial') }}">
                                <i class="fas fa-chart-line me-2"></i>
                                Relatório Financeiro
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports.members') }}">
                                <i class="fas fa-user-friends me-2"></i>
                                Relatório de Membros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reports.assets') }}">
                                <i class="fas fa-clipboard-list me-2"></i>
                                Relatório de Patrimônio
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('page-title', 'Dashboard')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('page-actions')
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

