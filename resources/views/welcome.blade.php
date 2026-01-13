<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Luxora — Location de Maisons & Appartements de Luxe</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
  
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <i class="bi bi-gem" style="font-size: 1.5rem; color: #d4af37;"></i> &nbsp;&nbsp;&nbsp;
      <a class="navbar-brand" href="#">Luxora</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a href="#hero" class="nav-link">Accueil</a></li>
          <li class="nav-item"><a href="#about" class="nav-link">À propos</a></li>
          <li class="nav-item"><a href="#offers" class="nav-link">Offres</a></li>
          <li class="nav-item"><a href="#testimonials" class="nav-link">Témoignages</a></li>
          <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>

          {{-- Liens d'authentification --}}
          @guest
              <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
          @endguest


         
          @auth
              @if (Auth::user()->role === 'client')
                  <li class="nav-item"><a href="{{ route('welcom.client') }}" class="nav-link">Mes logements</a></li>
              @elseif (Auth::user()->role === 'locateur')
                  <li class="nav-item"><a href=" {{ route('dashboard') }}" class="nav-link">Publier une annonce</a></li>
              @endif
               @if(auth()->user()->role === 'client')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client.reservations') }}">
                <i class="fas fa-calendar-check me-1"></i> Mes Réservations
            </a>
        </li>
    @endif

              <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">{{ Auth::user()->name }}</a></li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="nav-link btn btn-link text-danger" type="submit">Déconnexion</button>
                </form>
              </li>
          @endauth
          @auth
    
@endauth

        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero -->
<section id="hero" class="hero">
  <div class="hero-content" data-reveal>
    <h1>Trouvez la Maison de Vos Rêves</h1>
    <p>Découvrez une sélection exclusive de propriétés de prestige à louer dans le monde entier.</p>

    {{-- Section affichage par rôle directement dans le Hero --}}
    @auth
        @if(Auth::user()->role === 'locateur')
            <div class="mt-3">
                <span>Bonjour {{ Auth::user()->name }} ! Vous êtes propriétaire.</span>
                <br>
                <a href="{{ route('annonces.create') }}" class="btn btn-primary mt-2">Ajouter une Longement</a>
                <a href="#" class="btn btn-secondary mt-2">Gérer vos annonces</a>
            </div>
        @elseif(Auth::user()->role === 'client')
            <div class="mt-3">
                <span>Bonjour {{ Auth::user()->name }} ! Vous êtes un client.</span>
                <br>
                <a href="{{ route('welcom.client') }}" class="btn btn-gold btn-lg">Voir les logements disponibles</a>
            </div>
        @endif
    @else
        
        <a href="{{ route('login') }}" class="btn btn-gold mt-3">Se connecter</a>
        <a href="{{ route('register') }}" class="btn btn-gold mt-3">S'inscrire</a>
    @endauth

  </div>
</section>

  

 <!-- Search -->
<section class="container search-section" data-reveal>
    @auth
        @if(Auth::user()->role === 'client')
            <form class="row g-3" method="GET" action="{{ url('/') }}">
                <div class="col-md-4">
                    <label class="form-label">Lieu</label>
                    <input type="text" name="ville" class="form-control" placeholder="Paris, Monaco...">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Type de bien</label>
                    <select class="form-select" name="type">
                        <option value="">Tous</option>
                        <option value="Appartement">Appartement</option>
                        <option value="Villa">Villa</option>
                        <option value="Maison">Maison</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Budget / nuit (€)</label>
                    <input type="number" name="prix_max" class="form-control" placeholder="Ex: 500">
                </div>

                <div class="col-md-1 d-grid">
                    <button type="submit" class="btn btn-gold mt-4">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        @endif
    @endauth
</section>





  

<!-- Offers -->
<section id="offers" class="offers">
    <div class="container">
        <h2 class="text-center mb-5" data-reveal>Nos Offres Récentes</h2>

        @php
            use App\Models\Logement;

            $query = Logement::where('published', true);

            if (request('ville')) {
                $query->where('ville', 'like', '%' . request('ville') . '%');
            }

            if (request('type')) {
                $query->where('type', request('type'));
            }

            if (request('prix_max')) {
                $query->where('prix', '<=', request('prix_max'));
            }

            $logements = $query->get();
        @endphp

        <div class="row g-4">
            @forelse($logements as $logement)
                <div class="col-md-4" data-reveal>
                    <div class="card card-lux shadow-sm rounded-3 overflow-hidden">
                        @php
                            $photos = is_array($logement->photos) ? $logement->photos : json_decode($logement->photos, true);
                            $firstPhoto = 'img/default.jpg';

                            if (!empty($photos)) {
                                foreach ($photos as $photo) {
                                    if (is_array($photo)) {
                                        $firstPhoto = reset($photo);
                                        break;
                                    } elseif (is_string($photo)) {
                                        $firstPhoto = $photo;
                                        break;
                                    }
                                }
                            }
                        @endphp

                        <img src="{{ asset('storage/' . $firstPhoto) }}"
                             alt="{{ $logement->titre }}"
                             class="w-full h-48 object-cover rounded-top">

                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $logement->titre }}</h5>
                            <p class="text-muted mb-1">{{ $logement->ville }}, {{ $logement->adresse }}</p>
                            <p class="price text-primary fw-semibold">€ {{ $logement->prix }} / nuit</p>
                            <a href="{{ route('annonces.show', $logement->id) }}" class="btn btn-primary mt-2">Voir plus</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-danger fs-5 mt-4">
                    Aucune offre ne correspond à votre recherche.
                </p>
            @endforelse
        </div>
    </div>
</section>




  <!-- About -->
  <section id="about" class="about container">
    <div class="row align-items-center">
      <div class="col-md-6" data-reveal>
        <h3>À propos de Luxora</h3>
        <p>Luxora est une agence spécialisée dans la location de biens d’exception. Nous sélectionnons les propriétés les plus prestigieuses pour nos clients exigeants, avec un service personnalisé, une conciergerie complète et des expériences exclusives.</p>
      </div>
      <div class="col-md-6" data-reveal>
        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=800" alt="about" class="img-fluid rounded-3 shadow">
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section id="testimonials" class="testimonials">
    <div class="container text-center">
      <h2 class="mb-5" data-reveal>Ce que disent nos clients</h2>
      <div class="row g-4">
        <div class="col-md-4" data-reveal>
          <div class="testimonial-card">
            <p>"Un séjour inoubliable ! La villa était superbe et le service impeccable."</p>
            <div class="mt-3"><strong>— Emma L.</strong></div>
            <div class="mt-2">
              <i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i>
              <i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-reveal>
          <div class="testimonial-card">
            <p>"Service VIP, conciergerie disponible 24h/24, tout était parfait."</p>
            <div class="mt-3"><strong>— Marc D.</strong></div>
            <div class="mt-2">
              <i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i>
              <i class="bi bi-star-fill star"></i><i class="bi bi-star star"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-reveal>
          <div class="testimonial-card">
            <p>"Une expérience luxueuse du début à la fin. Je recommande Luxora sans hésiter."</p>
            <div class="mt-3"><strong>— Sofia K.</strong></div>
            <div class="mt-2">
              <i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i>
              <i class="bi bi-star-fill star"></i><i class="bi bi-star-fill star"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
 <section id="contact" class="contact container">
    <div class="text-center mb-5" data-reveal>
        <h2>Contactez-nous</h2>
        <p>Notre équipe vous accompagne dans votre recherche de propriété d’exception.</p>
    </div>
    <div class="row justify-content-center" data-reveal>
        <div class="col-md-8">

            <!-- Message succès -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Adresse email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-gold">Envoyer le message</button>
                </div>
            </form>
        </div>
    </div>
</section>


  <!-- Footer -->
  <footer>
    <div class="container">
      <p class="brand">Luxora</p>
      <p class="small mb-0">© <span id="year"></span> Luxora. Tous droits réservés.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
