<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentaireController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.register');
});
Route::post('/annonces/{id}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
Route::get('/dashboard', [AnnonceController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('logout.after.register');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::prefix('annonces')->middleware('auth')->group(function () {
    Route::get('/', [AnnonceController::class, 'index'])->name('annonces.index'); 
    Route::get('/create', [AnnonceController::class, 'create'])->name('annonces.create');
    Route::post('/', [AnnonceController::class, 'store'])->name('annonces.store');
    Route::get('/{id}', [AnnonceController::class, 'show'])->name('annonces.show'); 
    Route::get('/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('/{id}', [AnnonceController::class, 'update'])->name('annonces.update'); 
    Route::delete('/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
}
);