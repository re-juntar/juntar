<?php

use Illuminate\Support\Facades\Route;

// Laravel controllers
use App\Http\Controllers\EventController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\UserController;

// Livewire Front
use App\Http\Livewire\FrontHome;
use App\Http\Livewire\Inscriptions;
use App\Http\Livewire\PreinscriptionForm;
use App\Http\Livewire\PreinscriptionFormBuilder;
use App\Http\Livewire\ShowEvent;

// Livewire Back
use App\Http\Livewire\Backend\BackHome;
use App\Http\Livewire\Backend\UsersPage;
use App\Http\Livewire\Backend\EventsPage;
use App\Http\Livewire\Backend\EventCategoriesPage;
use App\Http\Livewire\Backend\EventModalitiesPage;
use App\Http\Livewire\Backend\EndorsementsPage;
use App\Http\Livewire\Backend\RolesPage;

Route::get('/', FrontHome::class)->name('home');

Route::get('/home', FrontHome::class);

Route::get('/sobre-nosotros', [AboutUsController::class, 'index'])->name('about-us');

Route::get('/evento/{id}', ShowEvent::class)->name('evento');

/********************** FRONTEND AUTH *************************/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/crear-evento', [EventController::class, 'create'])->name('create-event');

    Route::get('/editar-evento/{id}', [EventController::class, 'edit'])->name('edit-event');

    Route::post('/update-event', [EventController::class, 'update'])->name('update-event');

    Route::post('/store-event', [EventController::class, 'store'])->name('store-event');

    Route::get('/mis-inscripciones', [EventController::class, 'myInscriptions'])->name('my-inscriptions');

    Route::get('/mis-eventos', [EventController::class, 'myEvents'])->name('my-events');

    Route::post('/avales', [EndorsementsPage::class, 'store'])->name('avales');

    Route::get('/crear-formulario-preinscripcion/{eventId}', PreinscriptionFormBuilder::class)->name('formbuilder');

    Route::get('/evento/{eventId}/formulario-preinscripcion', PreinscriptionForm::class)->name('preinscripcionform');

    Route::get('/inscriptos/{eventId}', Inscriptions::class)->name('inscriptions');

    Route::get('/evento/{eventId}/inscribir', [InscriptionController::class, 'store'])->name('inscribir');

    Route::get('/evento/{eventId}/desinscribir', [InscriptionController::class, 'unsubscribe'])->name('unsubscribe');
});

/********************** VALIDATOR *************************/
Route::group(['middleware' => ['auth', 'validator'], 'prefix' => 'gestionar'], function () {
    Route::get('/', BackHome::class)->name('back-home');

    Route::get('/avales', EndorsementsPage::class)->name('endorsements');
});

/********************** BACKEND (includes validator paths) *************************/
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'gestionar'], function () {
    Route::get('/usuarios', UsersPage::class)->name('users');

    Route::get('/categorias', EventCategoriesPage::class)->name('event-category');

    Route::post('/user-academic-units', [UserController::class, 'updateUserAcademicUnits'])->name('user-academic-units');

    Route::get('/eventos', EventsPage::class)->name('events');

    Route::get('/modalidades', EventModalitiesPage::class,)->name('modalities');

    Route::get('/roles', RolesPage::class)->name('roles');
});

/********************* MAILING **************************/
Route::get('/contactanos', function () {
    return view('mail.index');
})->name('contact');
Route::post('exit', [ContactanosController::class, 'store'])->name('mail.store');
