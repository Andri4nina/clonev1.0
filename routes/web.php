<?php

use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalerieController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParametreController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ViewsCounterController;

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
Route::get('/', [PublicController::class, 'acceuil'])->name('public.acceuil');
Route::get('/comm{id}ntZone', [PublicController::class, 'CommentPubliZone'])->name('public.comment');
Route::post('/commntZone/comment', [CommentController::class,'storepublic'])->name('public.storecomment');

Route::get('/public/domain', [PublicController::class, 'domain'])->name('public.domain');
Route::get('/public/project', [PublicController::class, 'project'])->name('public.project');
Route::get('/public/about', [PublicController::class, 'about'])->name('public.about');
Route::get('/public/don', [PublicController::class, 'don'])->name('public.don');

/* Route::get('/public/comment{id}', [PublicController::class,'CommentPubliZone'])->name('public.comment');
Route::post('/public/', [CommentController::class,'store'])->name('publicComment.store'); */






/* Route d'authentification */
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('cache.no-cache');
Route::post('/dologin', [AuthController::class, 'doLogin'])->name('auth.dologin');

Route::get('/ajouter-vue', [ViewsCounterController::class, 'ajouter_vue']);
Route::get('/nombre-vue', [ViewsCounterController::class, 'nombre_vue']);



/* Route pour le dashboard */
Route::middleware(['auth'])->get('/dashboard', [DashController::class, 'index'])->name('dashboard.index');



Route::middleware(['auth'])->group(function () {
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/creation', [BlogController::class, 'create'])->name('blog.create');
Route::get('/blog/modif{id}cation', [BlogController::class, 'edit'])->name('blog.edit');
Route::get('/blog/cont{id}nu', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
Route::post('/blog/update', [BlogController::class, 'update'])->name('blog.update');
Route::post('/blog/approuved', [BlogController::class, 'approuved'])->name('blog.approuved');
Route::post('/blog/publish', [BlogController::class, 'publish'])->name('blog.publish');
Route::delete('/blog/{id}', [BlogController::class,'destroy'])->name('blog.destroy');
Route::post('/userpresponse', [CommentController::class,'storeresponse'])->name('blog.storeresponse');
Route::delete('/d{id}l', [CommentController::class,'DelCom'])->name('blog.delcomment');
});

/* Route pour les partenaires */
Route::middleware(['auth'])->group(function () {
Route::get('/partenaire', [PartController::class,'index'])->name('partenaire.index');
Route::get('/partenaire/creation', [PartController::class,'create'])->name('partenaire.create');
Route::get('/partenaire/modif{id}cation', [PartController::class,'edit'])->name('partenaire.edit');
Route::get('/partenaire/cont{id}nu', [PartController::class,'show'])->name('partenaire.show');
Route::post('/partenaire/store', [PartController::class,'store'])->name('partenaire.store');
Route::post('/partenaire/publish', [PartController::class, 'publish'])->name('partenaire.publish');
Route::delete('/partenaire/{id}', [PartController::class,'destroy'])->name('partenaire.destroy');
Route::post('/partenaire/update', [PartController::class,'update'])->name('partenaire.update');
});


/* Route pour les project */
Route::middleware(['auth'])->group(function () {
Route::get('/project', [ProjectController::class,'index'])->name('project.index');
Route::get('/project/creation', [ProjectController::class,'create'])->name('project.create');
Route::get('/project/modif{id}cation', [ProjectController::class,'edit'])->name('project.edit');
Route::get('/project/cont{id}nu', [ProjectController::class,'show'])->name('project.show');
Route::post('/project/store',[ProjectController::class, 'store'])->name('project.store');
Route::post('/project/publish', [ProjectController::class, 'publish'])->name('project.publish');
Route::post('/project/objectif', [ProjectController::class, 'done'])->name('project.objectif');
Route::delete('/project/{id}', [ProjectController::class,'destroy'])->name('project.destroy');
Route::post('/project/update', [ProjectController::class,'update'])->name('project.update');
});


/* Route pour les membres */
Route::middleware(['auth'])->group(function () {
Route::get('/membre', [MembersController::class,'index'])->name('membre.index');
Route::get('/membre/creation', [MembersController::class,'create'])->name('membre.create');
Route::get('/membre/modif{id}cation', [MembersController::class,'edit'])->name('membre.edit');
Route::post('/membre/store', [MembersController::class,'store'])->name('membre.store');
Route::post('/membre', [MembersController::class,'update'])->name('membre.update');
Route::delete('/membre/{id}', [MembersController::class,'destroy'])->name('membre.destroy');
});



/* Route pour les utilisateurs */
Route::middleware(['auth'])->group(function () {
Route::get('/utilisateur', [UserController::class, 'index'])->name('utilisateur.index');
Route::get('/utilisateur/creation', [UserController::class, 'create'])->name('utilisateur.create');
Route::get('/utilisateur/modif{id}cation', [UserController::class, 'edit'])->name('utilisateur.edit');
Route::get('/utilisateur/prof{id}l', [UserController::class, 'profil'])->name('utilisateur.profil');
Route::post('/utilisateur/store', [UserController::class,'store'])->name('utilisateur.store');
Route::post('/utilisateur', [UserController::class,'update'])->name('utilisateur.update');
Route::delete('/utilisateur/{id}', [UserController::class,'destroy'])->name('utilisateur.destroy');
Route::post('/utilisateur/mode', [UserController::class, 'mode'])->name('utilisateur.mode');
Route::post('/utilisateur/theme', [UserController::class, 'theme'])->name('utilisateur.theme');
});



/* Route pour les taches */
Route::middleware(['auth'])->group(function () {
Route::get('/tache', [TaskController::class, 'index'])->name('tache.index');
Route::post('/tache/CRUD', [TaskController::class, 'storeUpdate'])->name('tache.CRUD');
Route::delete('/tache/{id}', [TaskController::class,'destroy'])->name('tache.destroy');
Route::post('/tache/r{id}view', [TaskController::class,'review'])->name('tache.review');
Route::post('/tache/d{id}ne', [TaskController::class,'done'])->name('tache.done');
Route::post('/tache/pr{id}gress', [TaskController::class,'progress'])->name('tache.progress');
Route::post('/tache/impact', [TaskController::class,'incrementImpactValues'])->name('tache.impact');
});


/* Route pour les Messages */

Route::middleware(['auth'])->group(function () {
    Route::get('/messagerie', [MessageController::class, 'index'])->name('message.index');
    Route::post('/messagerie/add', [MessageController::class, 'addmessage'])->name('message.add');
});
/* Route pour les Galeries */
Route::middleware(['auth'])->group(function () {
    Route::get('/historique', [HistoriqueController::class, 'index'])->name('historique.index');

});
/* Route pour les Galeries */
Route::middleware(['auth'])->group(function () {
    Route::get('/galerie', [GalerieController::class, 'index'])->name('galerie.index');

});

/* Route pour les archive */
Route::middleware(['auth'])->group(function () {
Route::get('/archive', [ArchiveController::class, 'index'])->name('archive.index');
});

/* Route pour les parametre */
Route::middleware(['auth'])->group(function () {
Route::get('/parametre', [ParametreController::class, 'index'])->name('parametre.index');
Route::post('/parametre/update', [ParametreController::class, 'modifSelf'])->name('parametre.update');
});
