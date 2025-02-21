<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('annonces')->group(function () {
    Route::get('/', [AnnonceController::class, 'index'])->name('annonces.index'); // Liste des annonces
    Route::get('/create', [AnnonceController::class, 'create'])->name('annonces.create'); // Formulaire de création
    Route::post('/', [AnnonceController::class, 'store'])->name('annonces.store'); // Enregistrer une annonce
    Route::get('/{id}', [AnnonceController::class, 'show'])->name('annonces.show'); // Afficher une annonce
    Route::get('/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit'); // Formulaire d'édition
    Route::put('/{id}', [AnnonceController::class, 'update'])->name('annonces.update'); // Mettre à jour une annonce
    Route::delete('/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy'); // Supprimer une annonce
});