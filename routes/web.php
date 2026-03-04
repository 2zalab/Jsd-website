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
use App\Http\Controllers\Admin\PartenaireController;
use App\Http\Controllers\Admin\ActiviteController;
use App\Http\Controllers\Admin\RessourceController;

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
    Route::get('/hackathons/lycee',         [AdminController::class, 'showHackathonsLycee'])->name('hackathons.lycee');
    Route::get('/hackathons/superieur',     [AdminController::class, 'showHackathonsSuperieur'])->name('hackathons.superieur');
    Route::get('/generate-pdf-lycee',       [AdminController::class, 'generatePdfHackatonLycee']);
    Route::get('/hackathons/superieur/pdf', [AdminController::class, 'generatePdfHackatonSuperieur'])->name('admin.hackaton.superieur.pdf');

    Route::get('/admin/dashboard',     [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Messages
    Route::get('/messages',            [AdminController::class, 'getMessages'])->name('admin.messages');
    Route::delete('/messages/{message}',[AdminController::class, 'destroy'])->name('messages.destroy');

    // Concours programmeurs
    Route::get('/concours/cmpl',      [AdminController::class, 'getCmpl'])->name('concours.cmpl');
    Route::get('/concours/cmpl/pdf',  [AdminController::class, 'generatePdfCmpl'])->name('admin.cmpl.pdf');
    Route::get('/concours/cmps',      [AdminController::class, 'getCmps'])->name('concours.cmps');
    Route::get('/concours/cmps/pdf',  [AdminController::class, 'generatePdfCmps'])->name('admin.cmps.pdf');

    // Concours projets digitaux
    Route::get('/concours/cmpdl',     [AdminController::class, 'getCmpdl'])->name('concours.cmpdl');
    Route::get('/concours/cmpdl/pdf', [AdminController::class, 'generatePdfCmpdl'])->name('admin.cmpdl.pdf');
    Route::get('/concours/cmpds',     [AdminController::class, 'getCmpds'])->name('concours.cmpds');
    Route::get('/concours/cmpds/pdf', [AdminController::class, 'generatePdfCmpds'])->name('admin.cmpds.pdf');

    // Stands
    Route::get('/stands',     [AdminController::class, 'getStands'])->name('admin.stands');
    Route::get('/stands/pdf', [AdminController::class, 'generatePDF'])->name('stands.pdf');

    // Sponsors
    Route::get('/sponsors',              [AdminController::class, 'getSponsors'])->name('admin.sponsors');
    Route::get('/sponsors/pdf',          [AdminController::class, 'exportSponsorsPdf'])->name('admin.sponsors.pdf');
    Route::get('/sponsors/csv',          [AdminController::class, 'exportSponsorsCsv'])->name('admin.sponsors.csv');
    Route::delete('/sponsors/{sponsor}', [AdminController::class, 'destroySponsor'])->name('sponsors.destroy');

    // Newsletter
    Route::get('/newsletter',            [AdminController::class, 'getNewsletters'])->name('admin.newsletter');
    Route::get('/newsletter/export-csv', [AdminController::class, 'exportNewsletterCsv'])->name('admin.newsletter.csv');
    Route::delete('/newsletter/{id}',    [AdminController::class, 'destroyNewsletter'])->name('admin.newsletter.destroy');

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
    Route::post('/admin/utilisateurs',             [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::patch('/admin/utilisateurs/{id}/role',  [AdminController::class, 'updateUserRole'])->name('admin.users.role');
    Route::delete('/admin/utilisateurs/{id}',      [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/utilisateurs/export-pdf',   [AdminController::class, 'exportUsersPdf'])->name('admin.users.export.pdf');
    Route::get('/admin/utilisateurs/export-csv',   [AdminController::class, 'exportUsersCsv'])->name('admin.users.export.csv');

    // ── Notifications ─────────────────────────────────────────────────────────
    Route::get('/admin/notifications',  [AdminController::class, 'notificationsAdmin'])->name('admin.notifications');
    Route::post('/admin/notifications', [AdminController::class, 'sendNotification'])->name('admin.notifications.send');

    // ── Partenaires ───────────────────────────────────────────────────────────
    Route::get('/admin/partenaires',                [PartenaireController::class, 'index'])->name('admin.partenaires.index');
    Route::get('/admin/partenaires/creer',          [PartenaireController::class, 'create'])->name('admin.partenaires.create');
    Route::post('/admin/partenaires',               [PartenaireController::class, 'store'])->name('admin.partenaires.store');
    Route::get('/admin/partenaires/{id}/modifier',  [PartenaireController::class, 'edit'])->name('admin.partenaires.edit');
    Route::put('/admin/partenaires/{id}',           [PartenaireController::class, 'update'])->name('admin.partenaires.update');
    Route::delete('/admin/partenaires/{id}',        [PartenaireController::class, 'destroy'])->name('admin.partenaires.destroy');
    Route::patch('/admin/partenaires/{id}/toggle',  [PartenaireController::class, 'toggleActif'])->name('admin.partenaires.toggle');

    // ── Activités ─────────────────────────────────────────────────────────────
    Route::get('/admin/activites',                  [ActiviteController::class, 'index'])->name('admin.activites.index');
    Route::get('/admin/activites/creer',            [ActiviteController::class, 'create'])->name('admin.activites.create');
    Route::post('/admin/activites',                 [ActiviteController::class, 'store'])->name('admin.activites.store');
    Route::get('/admin/activites/{id}/modifier',    [ActiviteController::class, 'edit'])->name('admin.activites.edit');
    Route::put('/admin/activites/{id}',             [ActiviteController::class, 'update'])->name('admin.activites.update');
    Route::delete('/admin/activites/{id}',          [ActiviteController::class, 'destroy'])->name('admin.activites.destroy');

    // ── Ressources ────────────────────────────────────────────────────────────
    Route::get('/admin/ressources',                  [RessourceController::class, 'index'])->name('admin.ressources.index');
    Route::get('/admin/ressources/creer',            [RessourceController::class, 'create'])->name('admin.ressources.create');
    Route::post('/admin/ressources',                 [RessourceController::class, 'store'])->name('admin.ressources.store');
    Route::get('/admin/ressources/export-pdf',       [RessourceController::class, 'exportPdf'])->name('admin.ressources.export.pdf');
    Route::get('/admin/ressources/export-csv',       [RessourceController::class, 'exportCsv'])->name('admin.ressources.export.csv');
    Route::get('/admin/ressources/{id}/modifier',    [RessourceController::class, 'edit'])->name('admin.ressources.edit');
    Route::put('/admin/ressources/{id}',             [RessourceController::class, 'update'])->name('admin.ressources.update');
    Route::delete('/admin/ressources/{id}',          [RessourceController::class, 'destroy'])->name('admin.ressources.destroy');
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
