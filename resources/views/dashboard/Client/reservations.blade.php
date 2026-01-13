<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations - Luxora</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --gold: #d4af37;
            --dark: #1a1a1a;
            --light: #f8f9fa;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            padding-top: 80px; /* Pour compenser la navbar fixe */
            background-color: #f8f9fa;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark);
            font-size: 1.8rem;
        }
        
        .nav-link {
            color: #555 !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--gold) !important;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        .container-main {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-title {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--gold);
            position: relative;
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold), transparent);
        }
        
        .table-custom {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: none;
        }
        
        .table-custom thead {
            background: linear-gradient(135deg, var(--gold), #c19b2c);
            color: white;
        }
        
        .table-custom th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }
        
        .table-custom td {
            padding: 20px 15px;
            vertical-align: middle;
            border-color: #f1f1f1;
        }
        
        .table-custom tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-custom tbody tr:hover {
            background-color: #fffdf6;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .badge-status {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
        }
        
        .badge-waiting {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .badge-accepted {
            background-color: #d4edda;
            color: #155724;
        }
        
        .badge-refused {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .property-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #eee;
        }
        
        .property-info {
            display: flex;
            align-items: center;
        }
        
        .property-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        
        .property-location {
            color: #666;
            font-size: 0.9rem;
        }
        
        .date-cell {
            white-space: nowrap;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-icon {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .btn-gold {
            background: linear-gradient(135deg, var(--gold), #c19b2c);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-gold:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
            color: white;
        }
        
        footer {
            background: var(--dark);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        
        .brand-footer {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--gold);
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .table-custom th,
            .table-custom td {
                padding: 15px 10px;
                font-size: 0.9rem;
            }
            
            .property-info {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .property-image {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar CORRIGÉE -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <i class="bi bi-gem" style="font-size: 1.5rem; color: #d4af37;"></i> &nbsp;&nbsp;&nbsp;
            <a class="navbar-brand" href="{{ url('/') }}">Luxora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <!-- Accueil -->
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Accueil</a></li>
                    
                    <!-- À propos (si vous avez une section about) -->
                    <li class="nav-item"><a href="{{ url('/#about') }}" class="nav-link">À propos</a></li>
                    
                    <!-- Offres (si vous avez une section offers) -->
                    <li class="nav-item"><a href="{{ url('/#offers') }}" class="nav-link">Offres</a></li>
                    
                    <!-- Contact (si vous avez une section contact) -->
                    <li class="nav-item"><a href="{{ url('/#contact') }}" class="nav-link">Contact</a></li>

                    @auth
                        @if (Auth::user()->role === 'client')
                            <li class="nav-item">
                                <a href="{{ route('welcom.client') }}" class="nav-link">
                                    <i class="fas fa-search me-1"></i>Rechercher
                                </a>
                            </li>
                        @elseif (Auth::user()->role === 'locateur')
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link">
                                    <i class="fas fa-tachometer-alt me-1"></i>Tableau de bord
                                </a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if(auth()->user()->role === 'client')
                                <li>
                                    <a class="dropdown-item active" href="{{ route('client.reservations') }}">
                                        <i class="fas fa-calendar-check me-2"></i>Mes Réservations
                                    </a>
                                </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                    
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Inscription</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container container-main py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="page-title">Mes Réservations</h1>
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Logement</th>
                                <th>Date de réservation</th>
                                <th>Statut</th>
                                <th>Prix / nuit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($reservations as $res)
                            <tr>
                                <td>
                                    <div class="property-info">
                                        @if($res->logement && $res->logement->images && $res->logement->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $res->logement->images->first()->image_url) }}" 
                                                 alt="{{ $res->logement->titre }}" 
                                                 class="property-image">
                                        @else
                                            <div class="property-image d-flex align-items-center justify-content-center bg-light">
                                                <i class="fas fa-home fa-lg text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="property-title">
                                                {{ $res->logement->titre ?? 'Logement non disponible' }}
                                            </div>
                                            <div class="property-location">
                                                <i class="fas fa-map-marker-alt me-1"></i>
                                                {{ $res->logement->ville ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="date-cell">
                                    <strong>{{ $res->created_at->format('d/m/Y') }}</strong><br>
                                    <small class="text-muted">{{ $res->created_at->format('H:i') }}</small>
                                </td>

                                <td>
                                    @if($res->status == 'en_attente')
                                        <span class="badge badge-status badge-waiting">
                                            <i class="fas fa-clock me-1"></i>En attente
                                        </span>
                                    @elseif($res->status == 'accepte')
                                        <span class="badge badge-status badge-accepted">
                                            <i class="fas fa-check-circle me-1"></i>Acceptée
                                        </span>
                                    @elseif($res->status == 'refuse')
                                        <span class="badge badge-status badge-refused">
                                            <i class="fas fa-times-circle me-1"></i>Refusée
                                        </span>
                                    @endif
                                </td>
                                
                                <td>
                                    <strong class="text-primary">€ {{ $res->logement->prix ?? '0' }}</strong>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-calendar-times empty-icon"></i>
                                        <h4 class="mb-3">Aucune réservation trouvée</h4>
                                        <p class="text-muted mb-4">Vous n'avez effectué aucune réservation pour le moment.</p>
                                        <a href="{{ route('welcom.client') }}" class="btn btn-gold">
                                            <i class="fas fa-search me-2"></i>Voir les logements disponibles
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($reservations->count() > 0)
                <div class="mt-4 text-center">
                    <p class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        Vous avez {{ $reservations->count() }} réservation{{ $reservations->count() > 1 ? 's' : '' }}
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer CORRIGÉ -->
    <footer>
        <div class="container text-center">
            <p class="brand-footer">Luxora</p>
            <p class="small mb-0">© {{ date('Y') }} Luxora. Tous droits réservés.</p>
            <p class="small mt-2">
                <a href="{{ url('/') }}" class="text-light me-3">Accueil</a>
                <a href="{{ url('/#contact') }}" class="text-light me-3">Contact</a>
                <a href="#" class="text-light">Mentions légales</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animation pour les lignes du tableau
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.table-custom tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    if (alert.classList.contains('alert-dismissible')) {
                        const closeButton = alert.querySelector('.btn-close');
                        if (closeButton) closeButton.click();
                    }
                });
            }, 5000);
        });
    </script>
</body>
</html>