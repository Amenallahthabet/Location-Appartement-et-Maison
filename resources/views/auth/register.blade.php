
    <style>
        :root {
            --gold: #d4af37;
            --dark: #0d0d0d;
            --gray: #f4f4f4;
            --text: #202020;
            --white: #ffffff;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: var(--gray);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Conteneur du formulaire élargi */
        .register-container {
            background: var(--white);
            color: var(--text);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            padding: 3rem 3rem;
            width: 90%;        
            max-width: 600px;
            max-height: 720px;  
            text-align: center;
            position: relative;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--gold), transparent);
            border-radius: 22px;
            z-index: -1;
        }

        .register-container h1 {
            font-family: "Playfair Display", serif;
            color: var(--gold);
            margin-bottom: 1.8rem;
            font-size: 2rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.4rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: var(--text);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 0.85rem;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 5px rgba(212,175,55,0.6);
            outline: none;
        }

        .register-btn {
            background: var(--gold);
            color: var(--white);
            border: none;
            width: 100%;
            padding: 0.9rem;
            border-radius: 10px;
            font-weight: 700;
            margin-top: 1.8rem;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 1.05rem;
        }

        .register-btn:hover {
            background: #b9962f;
        }

        .already {
            display: block;
            text-align: right;
            margin-top: 1.2rem;
            color: var(--gold);
            font-size: 0.95rem;
            text-decoration: none;
        }

        .already:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .register-container {
                padding: 2rem 1.5rem;
                width: 95%;
                max-width: 95%;
            }
        }
    </style>

    <div class="register-container">
        <h1>Créer un compte</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nom -->
            <div class="form-group">
                <label for="name">Nom complet</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Entrez votre nom complet">
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Entrez votre adresse e-mail">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required placeholder="Entrez un mot de passe sécurisé">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Confirmation mot de passe -->
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Confirmez votre mot de passe">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600 text-sm" />
            </div>
            <!-- Numéro de téléphone -->
            <div class="form-group">
                <label for="num_tel">Numéro de téléphone</label>
                <input id="num_tel" type="text" name="num_tel" value="{{ old('num_tel') }}" required placeholder="Entrez votre numéro de téléphone" pattern="\d+">
                <x-input-error :messages="$errors->get('num_tel')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Rôle -->
            <div class="form-group">
                <label for="role">Type d'utilisateur</label>
                <select name="role" id="role" required>
                    <option value="client">Client</option>
                    <option value="locateur">Locateur</option>
                </select>
            </div>

            <!-- Bouton -->
            <button type="submit" class="register-btn">S'inscrire</button>

            <!-- Lien de connexion -->
            <a href="{{ route('login') }}" class="already">Déjà inscrit ? Se connecter</a>
        </form>
    </div>

