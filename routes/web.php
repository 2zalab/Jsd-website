<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;

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


Route::middleware('guest')->group(function () {
    Route::get('login', [UserController::class, 'showLoginForm'])
                ->name('login');

    Route::post('login', [UserController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('register', [UserController::class, 'showRegisterForm'])
    ->name('register');

    Route::post('register', [UserController::class, 'register']);


    Route::post('logout', [UserController::class, 'logout'])
                ->name('logout');

    Route::get('/admin', [AdminController::class, 'index'])
                ->name('admin.index');
                //->middleware('admin');

                // Hackathons
                Route::get('/hackathons/lycee', [AdminController::class, 'showHackathonsLycee'])->name('hackathons.lycee');
                Route::get('/hackathons/superieur', [AdminController::class, 'showHackathonsSuperieur'])->name('hackathons.superieur');
                Route::get('/generate-pdf-lycee', [AdminController::class, 'generatePdfHackatonLycee']);

                Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
                // Messages

            Route::get('/messages', [AdminController::class, 'getMessages'])->name('admin.messages');
            Route::delete('/messages/{message}', [AdminController::class, 'destroy'])->name('messages.destroy');


            // Concours meilleurs programmeurs
            Route::get('/concours/cmpl', [AdminController::class, 'getCmpl'])->name('concours.cmpl');
            Route::get('/concours/cmps', [AdminController::class, 'getCmps'])->name('concours.cmps');

            // Concours meilleurs projets digitaux
            Route::get('/concours/cmpdl', [AdminController::class, 'getCmpdl'])->name('concours.cmpdl');
            Route::get('/concours/cmpds', [AdminController::class, 'getCmpds'])->name('concours.cmpds');

            // Réservation stand
            Route::get('/stands', [AdminController::class, 'getStands'])->name('admin.stands');
            Route::get('/stands/pdf', [AdminController::class, 'generatePDF'])->name('stands.pdf');

            // Sponsoring
            Route::get('/sponsors', [AdminController::class, 'getSponsors'])->name('admin.sponsors');
            Route::delete('/sponsors/{sponsor}', [AdminController::class, 'destroySponsor'])->name('sponsors.destroy');

             // newsletter
             Route::get('/newsletter', [AdminController::class, 'getNewsletters'])->name('admin.newsletter');
    });

// Fallback route
Route::fallback(function () {
    return redirect()->route('login');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/activites', [HomeController::class, 'activities'])->name('activities');
Route::get('/photos', [HomeController::class, 'photos'])->name('photos');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');

Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/devenir-sponsor', [SponsorController::class, 'showForm'])->name('sponsor.form');
Route::post('/devenir-sponsor', [SponsorController::class, 'submitForm'])->name('sponsor.submit');

// Page principale des concours
Route::get('/concours', [ConcoursController::class, 'index'])->name('concours.index');

// Routes pour le concours de meilleur programmeur
Route::get('/concours/programmeur', [ConcoursController::class, 'createProgrammeur'])->name('concours.programmeur');
Route::post('/concours/programmeur', [ConcoursController::class, 'storeProgrammeur'])->name('concours.programmeur.submit');

// Routes pour le concours de meilleur projet digital
Route::get('/concours/projet-digital', [ConcoursController::class, 'createProjetDigital'])->name('concours.projet-digital');
Route::post('/concours/projet-digital', [ConcoursController::class, 'storeProjetDigital'])->name('concours.projet-digital.submit');

// Routes pour le Hackathon
Route::get('/concours/hackathon', [ConcoursController::class, 'createHackathon'])->name('concours.hackathon');
Route::post('/concours/hackathon', [ConcoursController::class, 'storeHackathon'])->name('concours.hackathon.submit');

// Routes pour la réservation de stand d'exposition
Route::get('/concours/stand', [ConcoursController::class, 'createStand'])->name('concours.stand');
Route::post('/concours/stand', [ConcoursController::class, 'storeStand'])->name('concours.stand.submit');

Route::get('/inscription-concours', [ConcoursController::class, 'index'])->name('concours.index');
Route::post('/inscription-concours', [ConcoursController::class, 'submitForm'])->name('concours.submit');

Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');


Route::get('/donate', [DonationController::class, 'index'])->name('donate.index');

