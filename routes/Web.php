<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;

// Test simple d'abord
Route::get('/test', function () {
    return '<h1>Route de test OK !</h1>';
});

// Page d'accueil
Route::get('/', [VehicleController::class, 'index'])->name('home');

// Entrée de véhicule
Route::get('/entree', [VehicleController::class, 'create'])->name('vehicles.create');
Route::post('/entree', [VehicleController::class, 'store'])->name('vehicles.store');

// Sortie de véhicule
Route::get('/sortie', [VehicleController::class, 'searchExit'])->name('vehicles.searchExit');
Route::post('/sortie/search', [VehicleController::class, 'search'])->name('vehicles.search');
Route::post('/sortie/{id}', [VehicleController::class, 'exit'])->name('vehicles.exit');

// Liste des véhicules garés
Route::get('/gares', [VehicleController::class, 'parked'])->name('vehicles.parked');

// Historique
Route::get('/historique', [VehicleController::class, 'history'])->name('vehicles.history');