<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
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

/*Simplified way of showing a route*/

Route::view ('/','welcome')-> name('welcome');

Route::get('/', function () {
    return view('welcome');
});

/*route to execute the index.blade.php views*/

// Route::get('/chirps', function () {
//     return view('chirps.index');
// });

/*Defines route '/chirps/{chirp?}' with authentication and verification,
 and returns the 'chirps.index' view concatenated with the optional 'chirp' parameter.*/

    // Route to display a list of chirps
    Route::get('/chirps', [ChirpController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('chirps.index');

    // Route to store a new chirp
    Route::post('/chirps', [ChirpController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('chirps.store');

    // Route to display the dashboard
    Route::get('/dashboard', [ChirpController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');   


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
