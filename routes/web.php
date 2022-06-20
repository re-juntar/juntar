<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Events;
use App\Http\Controllers\StoreEventController;
use Illuminate\Support\Facades\Route;

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

Route::post('/store-event', [StoreEventController::class, 'store'])->name('store-event');

Route::get('evento/organizar-eventos', [Events::class, 'render']);

/********************* MAILING **************************/
Route::get('/contactanos', function () {
    return view('mail.index');
})->name('contact');
Route::post('exit', [ContactanosController::class, 'store'])->name('mail.store');

/********************** BACKEND *************************/
Route::get('/gestionar', [BackendController::class, 'index'])->name('gestionar');
