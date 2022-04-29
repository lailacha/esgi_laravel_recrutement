<?php

use App\Http\Controllers\DomaineController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\CandidatureController;


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



Route::middleware(['auth','verified'])->group(function () {
    Route::group(['middleware' => ['role:admin']], function () {

        Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');

    });
    Route::group(['middleware' => ['role:candidat']], function () {
        Route::get('/candidatures/create/{offre}',
            [CandidatureController::class, 'create']
        )->middleware('can_create_candidature')->name('candidatures.create');
        Route::post('/candidatures/store/{offre}',
            [CandidatureController::class, 'store']
        )->name('candidatures.store');
        Route::get('/candidatures/show/{candidature}',
            [CandidatureController::class, 'show']
        )->name('candidatures.show');
        Route::get('/candidatures/showCandidatures/',
            [CandidatureController::class, 'showCandidatures']
        )->name('candidatures.showCandidaturesUser');
    });
    Route::group(['middleware' => ['role:recruteur']], function () {
        Route::get('/entreprises/create',
            [EntrepriseController::class, 'create']
        )->name('entreprises.create');

        Route::post('/entreprises/store',
            [EntrepriseController::class, 'store']
        )->name('entreprises.store');

        Route::get('/offres/create/',
            [OffreController::class, 'create'],
        )->name('offres.create');

        Route::post('/offres/store/{user}',
            [OffreController::class, 'store'],
        )->name('offres.store');

        Route::get('/offres/show/candidatures/{offre}',
            [OffreController::class, 'showCandidatures'],
        )->middleware('access_candidatures_recruteur')->name('offres.showCandiatures');

        Route::get('candidatures/download/cv/{candidature}', [CandidatureController::class, 'downloadCV'])->middleware('access_candidature_files')->name('candidatures.download.cv');
        Route::get('candidatures/download/lettre_motivation/{candidature}', [CandidatureController::class, 'downloadLM'])->middleware('access_candidature_files')->name('candidatures.download.lettre_motivation');

        Route::get('/entreprises/{entreprise}/assign', [EntrepriseController::class, 'assignForm'])->name('entreprises.assign.form');
        Route::post('/entreprises/assign/store', [EntrepriseController::class, 'assignUser'])->name('entreprises.assign');

    });
    Route::get('/entreprises', [EntrepriseController::class, 'index'])->name('entreprises.index');


    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard',
        [OffreController::class, 'index'],
    )->name('dashboard');

    // entreprises

    Route::get('/entreprises/show/{entreprise}',
        [EntrepriseController::class, 'show']
    )->name('entreprises.show');

    // offres

    Route::get('/offres',
        [OffreController::class, 'index'],
    )->name('offres.index');

    Route::get('/offres/show/{offre}',
        [OffreController::class, 'show'],
    )->name('offres.show');

    // domaines

    Route::get('/domaines',
        [DomaineController::class, 'index'],
    )->name('domaines.index');

    Route::get('/domaines/show/{domaine}',
        [DomaineController::class, 'show'],
    )->name('domaines.show');


    //Gestion des utilisateurs

    Route::group(['middleware' => ['show_user']], function () {
        Route::get('/users/show/{user}', [RegisteredUserController::class, 'show'])->name('users.show');

        Route::get('users/download/cv/{user}', [RegisteredUserController::class, 'downloadCV'])->name('users.download.cv');

        Route::get('users/edit/{user}', [RegisteredUserController::class, 'edit'])->name('users.edit');

        Route::post('users/update/{user}', [RegisteredUserController::class, 'update'])->name('users.update');

    });



});



require __DIR__.'/auth.php';
