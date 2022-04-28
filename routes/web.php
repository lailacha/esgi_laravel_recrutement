<?php

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

Route::get('/entreprises',
    [EntrepriseController::class, 'index']
)->middleware(['auth'])->name('index');

Route::get('/entreprises/show/{entreprise}',
    [EntrepriseController::class, 'show']
)->middleware(['auth'])->name('entreprise.show');

require __DIR__.'/auth.php';
