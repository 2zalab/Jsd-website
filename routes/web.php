<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AdminController;

// ─── Auth (invités uniquement) ────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login',   [UserController::class, 'login']);
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register',[UserController::class, 'register']);
});

// ─── Déconnexion ──────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

// ─── Dashboard Utilisateur ────────────────────────────────────────────────────
Route::middleware('auth')->prefix('mon-espace')->group(function () {
    Route::get('/',                 [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/notifications',    [UserDashboardController::class, 'notifications'])->name('dashboard.notifications');
    Route::post('/notifications/{id}/read', [UserDashboardController::class, 'markRead'])->name('dashboard.notifications.read');
    Route::post('/notifications/read-all',  [UserDashboardController::class, 'markAllRead'])->name('dashboard.notifications.read-all');
    Route::get('/profil',           [UserDashboardController::class, 'profile'])->name('dashboard.profile');
    Route::put('/profil',           [UserDashboardController::class, 'updateProfile'])->name('dashboard.profile.update');
    Route::put('/profil/password',  [UserDashboardController::class, 'updatePassword'])->name('dashboard.password.update');
});

// ─── Panel Admin (auth + rôle admin) ─────────────────────────────────────────
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin',             [AdminController::class, 'index'])->name('admin.index');

    // Hackathons
    Route::get('/hackathons/lycee',    [AdminController::class, 'showHackathonsLycee'])->name('hackathons.lycee');
    Route::get('/hackathons/superieur',[AdminController::class, 'showHackathonsSuperieur'])->name('hackathons.superieur');
    Route::get('/generate-pdf-lycee',  [AdminController::class, 'generatePdfHackatonLycee']);

    Route::get('/admin/dashboard',     [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Messages
    Route::get('/messages',            [AdminController::class, 'getMessages'])->name('admin.messages');
    Route::delete('/messages/{message}',[AdminController::class, 'destroy'])->name('messages.destroy');

    // Concours programmeurs
    Route::get('/concours/cmpl',  [AdminController::class, 'getCmpl'])->name('concours.cmpl');
    Route::get('/concours/cmps',  [AdminController::class, 'getCmps'])->name('concours.cmps');

    // Concours projets digitaux
    Route::get('/concours/cmpdl', [AdminController::class, 'getCmpdl'])->name('concours.cmpdl');
    Route::get('/concours/cmpds', [AdminController::class, 'getCmpds'])->name('concours.cmpds');

    // Stands
    Route::get('/stands',     [AdminController::class, 'getStands'])->name('admin.stands');
    Route::get('/stands/pdf', [AdminController::class, 'generatePDF'])->name('stands.pdf');

    // Sponsors
    Route::get('/sponsors',             [AdminController::class, 'getSponsors'])->name('admin.sponsors');
    Route::delete('/sponsors/{sponsor}',[AdminController::class, 'destroySponsor'])->name('sponsors.destroy');

    // Newsletter
    Route::get('/newsletter', [AdminController::class, 'getNewsletters'])->name('admin.newsletter');

    // ── Gestion unifiée des inscriptions ──────────────────────────────────────
    Route::get('/admin/inscriptions', [AdminController::class, 'inscriptions'])->name('admin.inscriptions');
    Route::patch('/admin/inscriptions/status', [AdminController::class, 'updateStatus'])->name('admin.inscriptions.status');

    // ── Programmeurs ──────────────────────────────────────────────────────────
    Route::get('/admin/programmeurs/creer',   [AdminController::class, 'createProgrammeurForm'])->name('admin.programmeurs.create');
    Route::post('/admin/programmeurs',        [AdminController::class, 'storeProgrammeurAdmin'])->name('admin.programmeurs.store');
    Route::delete('/admin/programmeurs/{id}', [AdminController::class, 'destroyProgrammeur'])->name('admin.programmeurs.destroy');

    // ── Projets Digitaux ──────────────────────────────────────────────────────
    Route::get('/admin/projets/creer',   [AdminController::class, 'createProjetForm'])->name('admin.projets.create');
    Route::post('/admin/projets',        [AdminController::class, 'storeProjetAdmin'])->name('admin.projets.store');
    Route::delete('/admin/projets/{id}', [AdminController::class, 'destroyProjet'])->name('admin.projets.destroy');

    // ── Hackathons ────────────────────────────────────────────────────────────
    Route::get('/admin/hackathons/creer',   [AdminController::class, 'createHackathonAdminForm'])->name('admin.hackathons.create');
    Route::post('/admin/hackathons',        [AdminController::class, 'storeHackathonAdmin'])->name('admin.hackathons.store');
    Route::delete('/admin/hackathons/{id}', [AdminController::class, 'destroyHackathonAdmin'])->name('admin.hackathons.destroy');

    // ── Stands ────────────────────────────────────────────────────────────────
    Route::get('/admin/stands/creer',   [AdminController::class, 'createStandAdminForm'])->name('admin.stands.create');
    Route::post('/admin/stands',        [AdminController::class, 'storeStandAdmin'])->name('admin.stands.store');
    Route::delete('/admin/stands/{id}', [AdminController::class, 'destroyStandAdmin'])->name('admin.stands.destroy');

    // ── Utilisateurs ──────────────────────────────────────────────────────────
    Route::get('/admin/utilisateurs',              [AdminController::class, 'users'])->name('admin.users');
    Route::patch('/admin/utilisateurs/{id}/role',  [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    Route::delete('/admin/utilisateurs/{id}',      [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // ── Notifications ─────────────────────────────────────────────────────────
    Route::get('/admin/notifications',  [AdminController::class, 'notificationsAdmin'])->name('admin.notifications');
    Route::post('/admin/notifications', [AdminController::class, 'sendNotification'])->name('admin.notifications.send');
});

// ─── Routes publiques ─────────────────────────────────────────────────────────
Route::get('/',       [HomeController::class, 'index'])->name('home');
Route::get('/activites', [HomeController::class, 'activities'])->name('activities');
Route::get('/a-propos',  [HomeController::class, 'about'])->name('about');

Route::get('/contact',  [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/devenir-sponsor', [SponsorController::class, 'showForm'])->name('sponsor.form');
Route::post('/devenir-sponsor',[SponsorController::class, 'submitForm'])->name('sponsor.submit');

Route::get('/photos',     [PhotoController::class, 'index'])->name('photos.index');
Route::get('/ressources', [PhotoController::class, 'index'])->name('ressources.index');
Route::get('/donate', [DonationController::class, 'index'])->name('donate.index');

// ─── Concours ─────────────────────────────────────────────────────────────────
Route::get('/concours', [ConcoursController::class, 'index'])->name('concours.index');

Route::get('/concours/programmeur',  [ConcoursController::class, 'createProgrammeur'])->name('concours.programmeur');
Route::post('/concours/programmeur', [ConcoursController::class, 'storeProgrammeur'])->name('concours.programmeur.submit');

Route::get('/concours/projet-digital',  [ConcoursController::class, 'createProjetDigital'])->name('concours.projet-digital');
Route::post('/concours/projet-digital', [ConcoursController::class, 'storeProjetDigital'])->name('concours.projet-digital.submit');

Route::get('/concours/hackathon',  [ConcoursController::class, 'createHackathon'])->name('concours.hackathon');
Route::post('/concours/hackathon', [ConcoursController::class, 'storeHackathon'])->name('concours.hackathon.submit');

Route::get('/concours/stand',  [ConcoursController::class, 'createStand'])->name('concours.stand');
Route::post('/concours/stand', [ConcoursController::class, 'storeStand'])->name('concours.stand.submit');

// ─── Fallback ─────────────────────────────────────────────────────────────────
Route::fallback(function () {
    return redirect()->route('home');
});
