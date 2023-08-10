<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;

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


/* Routes pour le public */
/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [PublicController::class, 'acceuil'])->name('public.acceuil');



/* Route d'authentification */
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('cache.no-cache');
Route::post('/dologin', [AuthController::class, 'doLogin'])->name('auth.dologin');


/* Route pour le dashboard */
Route::middleware(['auth'])->get('/dashboard', [DashController::class, 'index'])->name('dashboard.index')->middleware('auth');

/* Route pour les blogs */
Route::middleware(['auth'])->group(function () {
    Route::resource('publication', PublicationController::class);
    Route::post('/publication', [PublicationController::class, 'store'])->name('publication.store');
    Route::post('/publication/approved/{id}', [PublicationController::class,'approved'])->name('publication.approved'); 
    Route::put('/publication/publish/{id}', [PublicationController::class, 'publish'])->name('publication.publish');

});

/* Route pour les utilisateurs */
Route::middleware(['auth'])->group(function () {
    Route::resource('utilisateur', UserController::class);
    Route::post('/utilisateur/mode', [UserController::class, 'mode'])->name('utilisateur.mode');
    Route::post('/utilisateur/theme', [UserController::class, 'theme'])->name('utilisateur.theme');
});


/* Route pour les partenaires */
Route::middleware(['auth'])->group(function () {
    Route::resource('partenaire', PartController::class);
    Route::post('/partenaire/approved/{id}', [PartController::class,'approved'])->name('partenaire.approved'); 
    Route::put('/partenaire/publish/{id}', [PartController::class, 'publish'])->name('partenaire.publish');

});