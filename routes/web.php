<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Chirp;


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

Route::get('/chirps/{chirp?}', function ($chirp=null) {
    return view('chirps.index').$chirp;
})->middleware(['auth', 'verified'])->name('chirps.index');

// insert into database
Route::post('/chirps', function ($chirp=null) {
    return Chirp::create([

            'message'=> request('message'),
            'user_id'=> auth()->id(),

     ]);

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
