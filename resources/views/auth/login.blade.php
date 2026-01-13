<x-guest-layout>
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

        .login-container {
            background: var(--white);
            color: var(--text);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 420px;
            text-align: center;
            position: relative;
        }

        .login-container::before {
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

        .login-container h1 {
            font-family: "Playfair Display", serif;
            color: var(--gold);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: var(--text);
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 5px rgba(212,175,55,0.6);
            outline: none;
        }

        .remember {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .remember label {
            color: var(--text);
            font-weight: normal;
        }

        .login-btn {
            background: var(--gold);
            color: var(--white);
            border: none;
            width: 100%;
            padding: 0.8rem;
            border-radius: 10px;
            font-weight: 700;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #b9962f;
        }

        .forgot {
            display: block;
            text-align: right;
            margin-top: 1rem;
            color: var(--gold);
            font-size: 0.9rem;
            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
            }
        }
    </style>

    <div class="login-container">
        <h1>Connexion</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Adresse e-mail -->
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Entrez votre adresse e-mail">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required placeholder="Entrez votre mot de passe">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
            </div>

            <!-- Se souvenir de moi -->
            <div class="remember">
                <label for="remember_me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                @endif
            </div>

            <!-- Bouton -->
            <button type="submit" class="login-btn">Se connecter</button>
        </form>
    </div>
</x-guest-layout>
