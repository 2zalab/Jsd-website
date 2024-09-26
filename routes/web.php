<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\InscriptionConcoursController;
use App\Http\Controllers\NewsletterController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/activites', [HomeController::class, 'activities'])->name('activities');
Route::get('/photos', [HomeController::class, 'photos'])->name('photos');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
Route::get('/devenir-sponsor', [SponsorController::class, 'showForm'])->name('sponsor.form');
Route::post('/devenir-sponsor', [SponsorController::class, 'submitForm'])->name('sponsor.submit');
Route::get('/inscription-concours', [InscriptionConcoursController::class, 'showForm'])->name('concours.inscription');
Route::post('/inscription-concours', [InscriptionConcoursController::class, 'submitForm'])->name('concours.submit');

/*
Route::get('/', function () {
    return view('welcome');
});
*/
