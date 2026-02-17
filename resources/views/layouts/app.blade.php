<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion de Parking')</title>
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
  
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .main-content {
            min-height: calc(100vh - 120px);
            padding: 30px 0;
        }
        
        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,.08);
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,.2);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
            border: none;
        }
        
        .btn-info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
        }
        
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 5px;
        }

        /* Styles pour les boutons radio voiture/moto */
        .btn-check:checked + .btn-outline-primary {
            background-color: #0d6efd;
            color: white;
        }

        .btn-check:checked + .btn-outline-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-outline-primary:hover,
        .btn-outline-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,.2);
        }
    </style>
    
    @yield('styles')
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                 GESTION DE PARKING
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('vehicles.create') ? 'active' : '' }}" href="{{ route('vehicles.create') }}">
                            <i class="fas fa-plus-circle"></i> Nouvelle Entrée
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('vehicles.searchExit') ? 'active' : '' }}" href="{{ route('vehicles.searchExit') }}">
                            <i class="fas fa-sign-out-alt"></i> Sortie
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('vehicles.parked') ? 'active' : '' }}" href="{{ route('vehicles.parked') }}">
                            <i class="fas fa-car"></i> Véhicules Garés
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('vehicles.history') ? 'active' : '' }}" href="{{ route('vehicles.history') }}">
                            <i class="fas fa-history"></i> Historique
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

  
    <div class="container main-content">
        
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        
        @yield('content')
        
    </div>

   
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} Gestion de Parking - 
                 
                
            </p>
        </div>
    </footer>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    
    
</body>
</html>