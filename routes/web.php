<?php

use App\Http\Controllers\HomeController;
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

Route::view('/about-us', 'pages.about-us')->name('about-us');
