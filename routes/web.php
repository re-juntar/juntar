<?php

use App\Http\Livewire\Events;
use App\Http\Livewire\FrontHome;
use App\Http\Livewire\Inscriptions;
use App\Http\Livewire\MyInscriptions;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Backend\BackHome;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Backend\UsersPage;
use App\Http\Controllers\EventController;
use App\Http\Livewire\Backend\EventsPage;
use App\Http\Livewire\PreinscriptionForm;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BackendController;
use App\Http\Livewire\InscriptionsController;
use App\Http\Controllers\StoreEventController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\RedirectionController;
use App\Http\Livewire\Backend\EndorsementsPage;
use App\Http\Livewire\PreinscriptionFormBuilder;

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

Route::post('/home', FrontHome::class)->name('home');

Route::get('/', FrontHome::class)->name('home');

Route::get('/home', FrontHome::class)->name('home');

Route::get('/sobre-nosotros', [AboutUsController::class, 'index'])->name('about-us');

Route::get('/crear-evento', [EventController::class, 'create'])->name('create-event');

Route::get('/evento/{eventoId}', [EventController::class, 'show'])->name('evento');

Route::get('/editar-evento/{eventId}', [EventController::class, 'edit'])->name('edit-event');

Route::post('/update-event', [EventController::class, 'update'])->name('update-event');

Route::post('/store-event', [EventController::class, 'store'])->name('store-event');

Route::get('/mis-inscripciones', [EventController::class, 'myInscriptions'])->name('my-inscriptions');

Route::get('/mis-eventos', [EventController::class, 'myEvents'])->name('my-events');

/********************* MAILING **************************/
Route::get('/contactanos', function () {
    return view('mail.index');
})->name('contact');
Route::post('exit', [ContactanosController::class, 'store'])->name('mail.store');

/********************** BACKEND *************************/
Route::get('gestionar', BackHome::class)->name('back-home');

Route::get('/gestionar/usuarios', UsersPage::class)->name('users');

Route::get('/gestionar/eventos', EventsPage::class)->name('events');

Route::get('/gestionar/avales', EndorsementsPage::class)->name('endorsements');

/************************ HELPER **************************/
Route::get('/redirection/{url}', 'App\Http\Controllers\RedirectionController@externalUrl')->name('redirection');

Route::get('/crear-formulario-preinscripcion/{eventId}', PreinscriptionFormBuilder::class)->name('formbuilder');

Route::get('/formulario-preinscripcion/{eventId}', PreinscriptionForm::class)->name('preinscripcionform');

Route::get('/inscriptos/{eventId}', Inscriptions::class)->name('inscriptions');