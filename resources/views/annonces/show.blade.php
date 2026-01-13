<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $logement->titre }} - Luxora</title>
    
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
            background-color: #f8f9fa;
            padding-top: 80px; /* Pour compenser la navbar fixe */
        }
        
        /* Navbar */
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
        
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 30px 0;
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
        }
        
        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }
        
        .back-link {
            color: var(--gold);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
        }
        
        .back-link:hover {
            color: #c19b2c;
            transform: translateX(-5px);
        }
        
        /* Main Container */
        .container-main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px 60px;
        }
        
        /* Announcement Card */
        .announcement-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        
        .card-content {
            padding: 40px;
        }
        
        /* Gallery */
        .gallery-container {
            position: relative;
        }
        
        .main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        
        .thumbnail-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        
        .thumbnail {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        /* Info Section */
        .info-section {
            padding-left: 30px;
        }
        
        .property-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
        }
        
        .property-meta {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        
        .property-meta i {
            color: var(--gold);
            margin-right: 8px;
            width: 20px;
        }
        
        .property-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--gold);
            margin: 20px 0;
        }
        
        .property-description {
            color: #555;
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        
        /* Buttons */
        .btn-gold {
            background: linear-gradient(135deg, var(--gold), #c19b2c);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        
        .btn-gold:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(40, 167, 69, 0.3);
            color: white;
        }
        
        .btn-disabled {
            background: #9ca3af;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            cursor: not-allowed;
            opacity: 0.7;
        }
        
        /* Modal */
        .modal-gold .modal-header {
            background: linear-gradient(135deg, var(--gold), #c19b2c);
            color: white;
        }
        
        .locateur-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .locateur-info p {
            margin-bottom: 10px;
        }
        
        /* Features Grid */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 30px 0;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            color: #555;
        }
        
        .feature-item i {
            color: var(--gold);
            margin-right: 10px;
            font-size: 1.2rem;
            width: 25px;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .info-section {
                padding-left: 0;
                margin-top: 30px;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
            
            .card-content {
                padding: 20px;
            }
            
            .main-image {
                height: 300px;
            }
            
            .thumbnail-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .btn-gold, .btn-success {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Footer */
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
    </style>
</head>

<body>
    <!-- Navbar Luxora -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <i class="bi bi-gem" style="font-size: 1.5rem; color: #d4af37;"></i> &nbsp;&nbsp;&nbsp;
            <a class="navbar-brand" href="{{ url('/') }}">Luxora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="{{ url('/#about') }}" class="nav-link">À propos</a></li>
                    <li class="nav-item"><a href="{{ url('/#offers') }}" class="nav-link">Offres</a></li>
                    <li class="nav-item"><a href="{{ url('/#contact') }}" class="nav-link">Contact</a></li>

                    @auth
                        @if (Auth::user()->role === 'client')
                            <li class="nav-item">
                                <a href="{{ route('welcom.client') }}" class="nav-link">
                                    <i class="fas fa-search me-1"></i>Rechercher
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('client.reservations') }}" class="nav-link">
                                    <i class="fas fa-calendar-check me-1"></i>Mes Réservations
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
                                    <a class="dropdown-item" href="{{ route('client.reservations') }}">
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

    <!-- Header avec bouton retour -->
    <div class="page-header">
        <div class="header-content">
            <h1 class="page-title">Détails de l'annonce</h1>
            <a href="{{ route('welcom.client') }}" class="back-link">
                <i class="fas fa-arrow-left me-2"></i> Retour aux offres
            </a>
        </div>
    </div>

    <div class="container-main">
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

        <div class="announcement-card">
            <div class="card-content">
                <div class="row">
                    <!-- Galerie des photos -->
                    <div class="col-lg-7">
                        <div class="gallery-container">
                            @php
                                $photos = is_array($logement->photos) ? $logement->photos : json_decode($logement->photos, true);
                                $mainPhoto = asset('img/default.jpg');
                                
                                if(!empty($photos)) {
                                    $firstPhoto = is_array($photos[0]) ? reset($photos[0]) : $photos[0];
                                    $mainPhoto = asset('storage/' . $firstPhoto);
                                }
                            @endphp
                            
                            <img id="mainImage" src="{{ $mainPhoto }}" alt="Photo principale" class="main-image">
                            
                            @if(!empty($photos) && count($photos) > 1)
                            <div class="thumbnail-grid">
                                @foreach($photos as $index => $photo)
                                    @php 
                                        if(is_array($photo)) $photo = reset($photo);
                                        $thumbnailUrl = asset('storage/' . $photo);
                                    @endphp
                                    <img src="{{ $thumbnailUrl }}" 
                                         alt="Photo {{ $index + 1 }}" 
                                         class="thumbnail"
                                         onclick="changeMainImage('{{ $thumbnailUrl }}')">
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informations -->
                    <div class="col-lg-5">
                        <div class="info-section">
                            <h2 class="property-title">{{ $logement->titre }}</h2>
                            
                            <div class="property-meta">
                                <p><i class="fas fa-home"></i> {{ $logement->type }}</p>
                                <p><i class="fas fa-bed"></i> {{ $logement->nb_chambres }} chambre(s)</p>
                                <p><i class="fas fa-map-marker-alt"></i> {{ $logement->ville }}, {{ $logement->adresse }}</p>
                            </div>
                            
                            <div class="property-price">€ {{ number_format($logement->prix, 0, ',', ' ') }} / nuit</div>
                            
                            <div class="property-description">
                                {{ $logement->description ?? 'Pas de description fournie.' }}
                            </div>
                            
                            <!-- Features Grid -->
                            <div class="features-grid">
                                <div class="feature-item">
                                    <i class="fas fa-ruler-combined"></i>
                                    <span>Surface: {{ $logement->surface ?? 'N/A' }} m²</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-bath"></i>
                                    <span>Salle(s) de bain: {{ $logement->nb_salles_bain ?? 'N/A' }}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-car"></i>
                                    <span>Parking: {{ $logement->parking ? 'Oui' : 'Non' }}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-wifi"></i>
                                    <span>WiFi: {{ $logement->wifi ? 'Oui' : 'Non' }}</span>
                                </div>
                                @if($logement->equipement_cuisine)
                                <div class="feature-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>Cuisine équipée: Oui</span>
                                </div>
                                @endif
                                @if($logement->climatisation)
                                <div class="feature-item">
                                    <i class="fas fa-snowflake"></i>
                                    <span>Climatisation: Oui</span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Actions -->
                            <div class="mt-4">
                                @auth
                                    @if(auth()->user()->role === 'client')
                                        @if($logement->locateur)
                                            <button class="btn-gold" data-bs-toggle="modal" data-bs-target="#locateurModal{{ $logement->id }}">
                                                <i class="fas fa-envelope me-2"></i> Contacter
                                            </button>
                                            
                                            <a href="{{ route('reservation.store', $logement->id) }}" class="btn-success">
                                                <i class="fas fa-calendar-check me-2"></i> Réserver
                                            </a>
                                        @else
                                            <span class="btn-disabled">
                                                <i class="fas fa-exclamation-circle me-2"></i> Locateur non disponible
                                            </span>
                                        @endif
                                    @elseif(auth()->user()->role === 'locateur')
                                        <span class="btn-disabled">
                                            <i class="fas fa-user me-2"></i> Vous êtes le propriétaire
                                        </span>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn-gold">
                                        <i class="fas fa-sign-in-alt me-2"></i> Connectez-vous pour réserver
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Contact Locateur -->
    @if(auth()->check() && auth()->user()->role === 'client' && $logement->locateur)
    <div class="modal fade modal-gold" id="locateurModal{{ $logement->id }}" tabindex="-1" aria-labelledby="locateurModalLabel{{ $logement->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="locateurModalLabel{{ $logement->id }}">
                        <i class="fas fa-user-tie me-2"></i>Contacter le propriétaire
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="locateur-info">
                        <h6 class="mb-3">Informations du propriétaire :</h6>
                        <p><strong><i class="fas fa-user me-2"></i>Nom :</strong> {{ $logement->locateur->name }}</p>
                        <p><strong><i class="fas fa-envelope me-2"></i>Email :</strong> {{ $logement->locateur->email }}</p>
                        @if($logement->locateur->num_tel)
                        <p><strong><i class="fas fa-phone me-2"></i>Téléphone :</strong> {{ $logement->locateur->num_tel }}</p>
                        @endif
                    </div>
                    
                    <form action="{{ route('contact.locateur', $logement->locateur->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="logement_id" value="{{ $logement->id }}">
                        <input type="hidden" name="logement_titre" value="{{ $logement->titre }}">
                        
                        <div class="mb-3">
                            <label for="message{{ $logement->id }}" class="form-label fw-semibold">
                                <i class="fas fa-comment me-2"></i>Votre message :
                            </label>
                            <textarea name="message" id="message{{ $logement->id }}" class="form-control" rows="5" 
                                      placeholder="Bonjour, je suis intéressé(e) par votre logement '{{ $logement->titre }}'..." required></textarea>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn-gold">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Footer -->
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
        // Changer l'image principale
        function changeMainImage(imageUrl) {
            document.getElementById('mainImage').src = imageUrl;
        }
        
        // Animation pour le contenu
        document.addEventListener('DOMContentLoaded', function() {
            // Effet de fade in pour le contenu
            const content = document.querySelector('.announcement-card');
            content.style.opacity = '0';
            content.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                content.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                content.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            }, 300);
            
            // Auto-dismiss alerts
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    if (alert.classList.contains('alert-dismissible')) {
                        const closeButton = alert.querySelector('.btn-close');
                        if (closeButton) closeButton.click();
                    }
                });
            }, 5000);
            
            // Modal auto-focus
            const locateurModal = document.getElementById('locateurModal{{ $logement->id }}');
            if (locateurModal) {
                locateurModal.addEventListener('shown.bs.modal', function () {
                    document.getElementById('message{{ $logement->id }}').focus();
                });
            }
        });
    </script>
</body>
</html>