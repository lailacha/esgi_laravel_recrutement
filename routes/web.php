<?php

use App\Http\Controllers\DomaineController;
use App\Http\Controllers\OffreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', "verified"])->name('dashboard');

// entreprises

Route::get('/entreprises',
    [EntrepriseController::class, 'index']
)->middleware(['auth'])->name('index');

Route::get('/entreprises/show/{entreprise}',
    [EntrepriseController::class, 'show']
)->middleware(['auth'])->name('entreprises.show');

// offres

Route::get('/offres',
    [OffreController::class, 'index'],
)->middleware(['auth'])->name('offres.index');

Route::get('/offres/show/{offre}',
    [OffreController::class, 'show'],
)->middleware(['auth'])->name('offres.show');

Route::get('/offres/create/',
    [OffreController::class, 'create'],
)->middleware(['auth'])->name('offres.create');

Route::post('/offres/store/{user}',
    [OffreController::class, 'store'],
)->middleware(['auth'])->name('offres.store');

// domaines

Route::get('/domaines',
    [DomaineController::class, 'index'],
)->middleware(['auth'])->name('domaines.index');

Route::get('/domaines/show/{domaine}',
    [DomaineController::class, 'show'],
)->middleware(['auth'])->name('domaines.show');

Route::get('/domaines/create/',
    [DomaineController::class, 'create'],
)->middleware(['auth'])->name('domaines.create');

require __DIR__.'/auth.php';
