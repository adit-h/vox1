<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth.session', 'web'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'organizer', 'as' => 'organizer.'], function () {
        Route::get('/', [OrganizerController::class, 'index'])->name('index');
        Route::get('/create', [OrganizerController::class, 'create'])->name('create');
        Route::post('/store', [OrganizerController::class, 'store'])->name('store');
        //Route::get('/{id}', [OrganizerController::class, 'read'])->name('read');
        Route::get('/edit/{id}', [OrganizerController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [OrganizerController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [OrganizerController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        //Route::get('/{id}', [EventController::class, 'read'])->name('read');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EventController::class, 'delete'])->name('delete');
    });
});
