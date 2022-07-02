<?php

use App\Http\Livewire\Events;
use App\Http\Livewire\Backend\BackHome;
use App\Http\Livewire\MyInscriptions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Backend\UsersPage;
use App\Http\Controllers\EventController;
use App\Http\Livewire\Backend\EventsPage;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BackendController;
use App\Http\Livewire\InscriptionsController;
use App\Http\Controllers\StoreEventController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\EventModalityController;
use App\Http\Livewire\Backend\CreateEventModality;
use App\Http\Livewire\Backend\CreateModality;
use App\Http\Livewire\Backend\EditModality;
use App\Http\Livewire\Backend\EditModalityt;
use App\Http\Livewire\Backend\EndorsementsPage;
use App\Http\Livewire\Backend\EventModalities;
use App\Http\Livewire\EventModalitiesPage;
use App\Models\EventModality;

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


Route::get('/', [HomeController::class, 'filteredIndex'])->name('home');

Route::get('/home', [HomeController::class, 'filteredIndex'])->name('home');

Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');

Route::view('/create-event', 'pages.create-event')->name('create-event');

Route::get('/eventos/evento/{eventoId}', [EventController::class, 'show'])->name('evento');

Route::get('/edit-event/{eventid}', [EventController::class, 'edit'])->name('edit-event');

Route::post('/update-event', [StoreEventController::class, 'update'])->name('update-event');

Route::post('/store-event', [StoreEventController::class, 'store'])->name('store-event');

Route::get('/cuenta/mis-inscripciones-a-eventos', [MyInscriptions::class, 'render'])
    ->name('my-inscriptions');

Route::get('/evento/organizar-eventos', [Events::class, 'render'])->name('my-events');

/********************* MAILING **************************/
Route::get('/contact-us', function () {
    return view('mail.index');
})->name('contact');
Route::post('exit', [ContactanosController::class, 'store'])->name('mail.store');

/********************** BACKEND *************************/
/* Route::get('/gestionar', [BackendController::class, 'index'])->name('management'); */

Route::get('gestionar', BackHome::class)->name('back-home');

Route::get('/gestionar/usuarios', UsersPage::class)->name('users');

Route::get('/gestionar/eventos', EventsPage::class)->name('events');

Route::get('/gestionar/avales', EndorsementsPage::class)->name('endorsements');

Route::get('/gestionar/modalidades', EventModalitiesPage::class,)->name('eventModalities');

Route::get('/gestionar/modalidades/agregar', CreateModality::class)->name('addModality');

// Route::get('/gestionar/modalidades/editar/{id}', EditModalityt::class,'edit')->name('editModality');
Route::get('/gestionar/modalidades/editar/{id}', EditModality::class, 'render')->name('editModality');
