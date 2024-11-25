<?php

use App\Http\Controllers\CaissiereController;
use App\Http\Controllers\ClientCommandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BurgerController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;

//Route::get('/', function () {return view('welcome');});
Route::get('/accueil', [AuthController::class, 'home'])->name('home');


// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour le client
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/catalogue', [ClientCommandeController::class, 'catalogue'])->name('clients.catalogue');
    Route::get('/commande/{burger}', [ClientCommandeController::class, 'commander'])->name('clients.commander');
    Route::post('/commande', [ClientCommandeController::class, 'passerCommande'])->name('clients.passer-commande');
    Route::get('/mes-commandes', [ClientCommandeController::class, 'mesCommandes'])->name('clients.mes-commandes');
    Route::get('/commande/{commande}', [ClientCommandeController::class, 'detailCommande'])->name('clients.detail-commande');
});

// Routes pour la caissière
Route::middleware(['auth', 'role:caissiere'])->prefix('caissiere')->group(function () {
    Route::get('/commandes', [CaissiereController::class, 'index'])->name('caissieres.commandes');
    Route::get('/commandes/{commande}', [CaissiereController::class, 'show'])->name('caissieres.show');
    Route::post('/commandes/{commande}/update-status', [CaissiereController::class, 'updateStatus'])->name('caissieres.update-status');
    Route::post('/commandes/{commande}/enregistrer-paiement', [CaissiereController::class, 'enregistrerPaiement'])->name('caissieres.enregistrer-paiement');
    Route::get('/recherche', [CaissiereController::class, 'recherche'])->name('caissiere.recherche');
});

// Routes pour l'admin (à implémenter)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('/burgers',BurgerController::class);
    Route::resource('/clients',ClientController::class);
    Route::resource('/commandes',CommandeController::class);
    Route::resource('/paiements',PaiementController::class);
    Route::resource('/users',UserController::class);
    Route::get('/statistiques', [CommandeController::class, 'statistiques'])->name('commande.statistiques');
});
