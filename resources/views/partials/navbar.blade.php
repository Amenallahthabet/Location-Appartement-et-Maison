<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Luxora</a>

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

        {{-- Ici, selon le rôle de l'utilisateur --}}
        @auth
            @if (Auth::user()->role === 'client')
                <li class="nav-item">
                    <a href="{{ route('logements.index') }}" class="nav-link">Voir les logements</a>
                </li>
            @elseif (Auth::user()->role === 'locateur')
                <li class="nav-item">
                    <a href="{{ route('annonces.create') }}" class="nav-link">Publier une annonce</a>
                </li>
            @endif

            {{-- Lien vers profil et déconnexion --}}
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link">{{ Auth::user()->name }}</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link btn btn-link text-danger" type="submit">Déconnexion</button>
                </form>
            </li>
        @else
            {{-- Si non connecté --}}
            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
