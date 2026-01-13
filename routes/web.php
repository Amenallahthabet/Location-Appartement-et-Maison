<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogementController;
use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard selon le rôle
Route::get('/dashboard', function () {
    if(auth()->user()->role === 'locateur'){
        // Pour locateur : récupérer ses logements
        $logements = auth()->user()->logements; 
        return view('dashboard', compact('logements'));
    }

    // Pour client : juste afficher le dashboard
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes protégées (auth requise)
Route::middleware(['auth'])->group(function () {

    // Profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pour les clients  voir les logements
    Route::get('/welcom-client', [LogementController::class, 'index'])
        ->name('welcom.client');

    // Pour les locateurs  gérer leurs annonces
    Route::get('/welcom-locateur', [AnnonceController::class, 'index'])
        ->name('welcom.locateur');

    // Ajouter un logement  afficher le formulaire
    Route::get('/annonces/create', [LogementController::class, 'create'])
        ->name('annonces.create');

    // Stocker le logement après soumission du formulaire
    Route::post('/annonces', [LogementController::class, 'store'])
        ->name('annonces.store');

    // Modifier un logement
    Route::get('/annonces/{logement}/edit', [LogementController::class, 'edit'])
        ->name('annonces.edit');

    // Mettre à jour un logement
    Route::put('/annonces/{logement}', [LogementController::class, 'update'])
        ->name('annonces.update');

    // Supprimer un logement
    Route::delete('/annonces/{logement}', [LogementController::class, 'destroy'])
        ->name('annonces.destroy');
    // publier annonce 
    Route::post('/annonces/{id}/publish', [LogementController::class, 'publish'])->name('annonces.publish');
     // unpublier annonce 
    Route::post('/annonces/{id}/unpublish', [LogementController::class, 'unpublish'])->name('annonces.unpublish');
    // voire plus 
    Route::get('/annonces/{id}', [LogementController::class, 'regarderPlus'])->name('annonces.show');
    // recherche
    Route::get('/recherche', [LogementController::class, 'search'])->name('logements.search');
    // envoyer l'eamil
    Route::post('/contact-locateur/{id}', [LogementController::class, 'send'])->name('contact.locateur');
    // envouer eamil a admin
    Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact.send');
    // Créer une réservation
    Route::get('/reservation/{logment}', [ReservationController::class, 'store'])->name('reservation.store');
    // Liste des réservations pour le locateur
    Route::get('/locateur/reservations', [ReservationController::class, 'locateurReservations'])->name('locateur.reservations');
    //acepter reservation
    Route::post('/reservation/accepter/{id}', [ReservationController::class, 'accepterReservation'])->name('reservation.accepter');
    //refuser reservation
    Route::post('/reservation/refuser/{id}', [ReservationController::class, 'refuserReservation'])->name('reservation.refuser');
    // reservation client show
    Route::get('/mes-reservations', [ReservationController::class, 'mesReservations'])->name('client.reservations');



});

require __DIR__.'/auth.php';
