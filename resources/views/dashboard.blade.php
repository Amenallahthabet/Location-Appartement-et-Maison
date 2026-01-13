<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight"> 
            Tableau de bord  
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="{{ route('home') }}" class="font-semibold text-2xl text-gray-800 leading-tight">Accéder Accueil</a>
            @if(auth()->user()->role === 'locateur')
                &nbsp;&nbsp;&nbsp;
                <a href="{{ route('locateur.reservations') }}" 
                   class="font-semibold text-2xl text-indigo-600 hover:text-indigo-800">
                   Mes Réservations
                </a>
            @endif

        </h2>
    </x-slot>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
        }
        .dashboard-container { max-width: 1200px; margin:auto; padding:20px; }
        .card { background-color:#fff; border-radius:12px; padding:20px; box-shadow:0 6px 12px rgba(0,0,0,0.1); margin-bottom:30px; }
        .card h3 { margin-bottom:20px; color:#1f2937; }
        .form-group { margin-bottom:15px; }
        .form-group label { font-weight:600; display:block; margin-bottom:5px; color:#374151; }
        .form-control, .form-select { width:100%; padding:10px; border-radius:8px; border:1px solid #d1d5db; font-size:14px; color:#374151; }
        .form-control:focus, .form-select:focus { outline:none; border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,0.2); }
        .btn { padding:10px 20px; border-radius:8px; font-weight:600; cursor:pointer; transition:all 0.3s ease; border:none; }
        .btn-primary { background-color:#6366f1; color:white; }
        .btn-primary:hover { background-color:#4f46e5; }
        .btn-warning { background-color:#fbbf24; color:white; }
        .btn-warning:hover { background-color:#f59e0b; }
        .btn-danger { background-color:#ef4444; color:white; }
        .btn-danger:hover { background-color:#dc2626; }
        table { width:100%; border-collapse:collapse; margin-top:15px; }
        th, td { padding:12px; text-align:left; border-bottom:1px solid #e5e7eb; }
        th { background-color:#f3f4f6; font-weight:600; }
        img { border-radius:6px; margin-right:5px; }
        .actions form { display:inline; }
    </style>

    <div class="dashboard-container">

        @if(auth()->user()->role === 'locateur')

            {{-- Formulaire Ajouter / Editer un logement --}}
            <div class="card">
                <h3>{{ isset($logement) ? 'Modifier le logement' : 'Ajouter un logement' }}</h3>
                <form action="{{ isset($logement) ? route('annonces.update', $logement->id) : route('annonces.store') }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($logement))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label>Titre</label>
                        <input type="text" name="titre" class="form-control" 
                               value="{{ old('titre', $logement->titre ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ old('description', $logement->description ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-select" required>
                            <option value="Appartement" {{ (old('type', $logement->type ?? '') == 'Appartement') ? 'selected' : '' }}>Appartement</option>
                            <option value="Villa" {{ (old('type', $logement->type ?? '') == 'Villa') ? 'selected' : '' }}>Villa</option>
                            <option value="Maison" {{ (old('type', $logement->type ?? '') == 'Maison') ? 'selected' : '' }}>Maison</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" name="adresse" class="form-control" 
                               value="{{ old('adresse', $logement->adresse ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Ville</label>
                        <input type="text" name="ville" class="form-control" 
                               value="{{ old('ville', $logement->ville ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Nombre de chambres</label>
                        <input type="number" name="nb_chambres" class="form-control" min="1" 
                               value="{{ old('nb_chambres', $logement->nb_chambres ?? 1) }}">
                    </div>

                    <div class="form-group">
                        <label>Prix / nuit (€)</label>
                        <input type="number" name="prix" class="form-control" step="0.01" 
                               value="{{ old('prix', $logement->prix ?? '') }}" required>
                    </div>

                    {{-- Photos existantes --}}
                    @if(isset($logement) && !empty($logement->photos))
                        <div style="display:flex; flex-wrap:wrap; gap:5px; margin-bottom:10px;">
                            @foreach(json_decode($logement->photos, true) as $photo)
                                <img src="{{ asset('storage/' . $photo) }}" width="70" height="70" style="object-fit: cover; border-radius:8px;">
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Photos (jusqu’à 10)</label>
                        <input type="file" name="photos[]" class="form-control" accept="image/*" multiple required>
                        <small class="text-muted">Choisissez jusqu’à 10 images depuis votre ordinateur.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ isset($logement) ? 'Modifier' : 'Ajouter' }}</button>
                </form>
            </div>

            {{-- Liste des logements --}}
            <div class="card">
                <h3>Mes logements</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Chambres</th>
                            <th>Photos</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logements as $logement)
                            <tr>
                                <td>{{ $logement->titre }}</td>
                                <td>{{ $logement->description }}</td>
                                <td>{{ $logement->type }}</td>
                                <td>{{ $logement->adresse }}</td>
                                <td>{{ $logement->ville }}</td>
                                <td>{{ $logement->nb_chambres }}</td>
                                <td>
                                    @php
                                        $photos = is_array($logement->photos) ? $logement->photos : json_decode($logement->photos, true);
                                        $firstPhoto = $photos[0] ?? 'img/default.jpg';
                                    @endphp                                    
                                    @if(!empty($photos))
                                        <div style="display:flex; flex-wrap:wrap; gap:5px;">
                                            @foreach($photos as $photo)
                                                @if(is_string($photo))
                                                    <img src="{{ asset('storage/' . $photo) }}" width="70" height="70" style="object-fit: cover; border-radius:8px;">
                                                @endif
                                            @endforeach
                                        </div>
                                    @elseif(!empty($photos))
                                        <img src="{{ asset('img/default.jpg') }}" alt="photo" class="w-full h-64 object-cover rounded">
                                    @else
                                        <span style="color:#999;">Aucune photo</span>
                                    @endif
                                </td>
                                <td>{{ $logement->prix }} €</td>
                                <td class="actions">

    {{-- Bouton Modifier --}}
    <a href="{{ route('annonces.edit', $logement->id) }}" 
       class="btn btn-warning btn-sm">Modifier</a>

    {{-- Bouton Supprimer --}}
    <form action="{{ route('annonces.destroy', $logement->id) }}" 
          method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
    </form>

    {{-- Boutons Publier / Annuler --}}
    @if(!$logement->published)

        {{-- Si l'annonce n'est PAS publiée  afficher Publier --}}
        <form action="{{ route('annonces.publish', $logement->id) }}" 
              method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-primary btn-sm" type="submit">Publier l'annonce</button>
        </form>

    @else

        {{-- Si l'annonce est publiée afficher Annuler la publication --}}
        <form action="{{ route('annonces.unpublish', $logement->id) }}" 
              method="POST" style="display:inline;">
            @csrf
            <button class="btn btn-secondary btn-sm" type="submit">Annuler la publication</button>
        </form>

    @endif

</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            {{-- Pour les clients --}}
            <div class="card">
                <h3>Voir les logements disponibles</h3>
                <a href="{{ route('welcom.client') }}" class="btn btn-primary">Accéder aux logements</a>
            </div>
        @endif

    </div>
</x-app-layout>
