<?php

use Illuminate\Support\Facades\Route;

// Laravel controllers
use App\Http\Controllers\EventController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\InscriptionController;

// Livewire Front
use App\Http\Livewire\FrontHome;
use App\Http\Livewire\Inscriptions;
use App\Http\Livewire\PreinscriptionForm;
use App\Http\Livewire\EventModalitiesPage;
use App\Http\Livewire\PreinscriptionFormBuilder;
use App\Http\Livewire\ShowEvent;

// Livewire Back
use App\Http\Livewire\Backend\BackHome;
use App\Http\Livewire\Backend\UsersPage;
use App\Http\Livewire\Backend\EventsPage;
use App\Http\Livewire\Backend\EventCategoriesPage;
use App\Http\Livewire\Backend\CreateModality;
use App\Http\Livewire\Backend\EditModality;
use App\Http\Livewire\Backend\EndorsementsPage;
use App\Http\Livewire\Backend\RolesPage;

Route::get('/', FrontHome::class)->name('home');

Route::get('/home', FrontHome::class);

Route::get('/sobre-nosotros', [AboutUsController::class, 'index'])->name('about-us');

Route::get('/crear-evento', [EventController::class, 'create'])->name('create-event');

Route::get('/evento/{id}', ShowEvent::class)->name('evento');

Route::get('/editar-evento/{id}', [EventController::class, 'edit'])->name('edit-event');

Route::post('/update-event', [EventController::class, 'update'])->name('update-event');

Route::post('/store-event', [EventController::class, 'store'])->name('store-event');

Route::get('/mis-inscripciones', [EventController::class, 'myInscriptions'])->name('my-inscriptions');

Route::get('/mis-eventos', [EventController::class, 'myEvents'])->name('my-events');

Route::post('/avales', [EndorsementsPage::class, 'store'])->name('avales');

Route::get('/crear-formulario-preinscripcion/{eventId}', PreinscriptionFormBuilder::class)->name('formbuilder');

Route::get('/formulario-preinscripcion/{eventId}', PreinscriptionForm::class)->name('preinscripcionform');

Route::get('/inscriptos/{eventId}', Inscriptions::class)->name('inscriptions');

Route::get('/inscribir/{eventId}', [InscriptionController::class, 'store'])->name('inscribir');

/********************* MAILING **************************/
Route::get('/contactanos', function () {
    return view('mail.index');
})->name('contact');
Route::post('exit', [ContactanosController::class, 'store'])->name('mail.store');

/********************** BACKEND *************************/
Route::group(['middleware' => ['auth'], 'prefix' => 'gestionar'], function () {
    Route::get('/', BackHome::class)->name('back-home');

    Route::get('/event-category', EventCategoriesPage::class)->name('event-category');

    Route::get('/', BackHome::class)->name('back-home');

    Route::get('/usuarios', UsersPage::class)->name('users');

    Route::get('/eventos', EventsPage::class)->name('events');

    Route::get('/avales', EndorsementsPage::class)->name('endorsements');

    Route::get('/modalidades', EventModalitiesPage::class,)->name('eventModalities');

    Route::get('/modalidades/agregar', CreateModality::class)->name('addModality');

    Route::get('/modalidades/editar/{id}', EditModality::class, 'render')->name('editModality');

    Route::get('/avales', EndorsementsPage::class)->name('endorsements');

    Route::get('/roles', RolesPage::class)->name('roles');
});
