<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnonceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware <gr></gr>oup. Make something great!
|
*/
Route::get('/', function () {
    return view('auth.register');
});
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('logout.after.register');
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
    Route::get('/', [AnnonceController::class, 'index'])->name('annonces.index'); 
    Route::get('/create', [AnnonceController::class, 'create'])->name('annonces.create');
    Route::post('/', [AnnonceController::class, 'store'])->name('annonces.store');
    Route::get('/{id}', [AnnonceController::class, 'show'])->name('annonces.show'); 
    Route::get('/{id}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('/{id}', [AnnonceController::class, 'update'])->name('annonces.update'); 
    Route::delete('/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
});