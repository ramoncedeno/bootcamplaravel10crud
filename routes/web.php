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
    // Create the chirp with the provided data
    $chirp = Chirp::create([
        'message' => request('message'),
        'user_id' => auth()->id(),
    ]);

    // // allows to validate the user session (other form)
    //  session()->flash('status','Chirp created successfully!');

    // Redirect to the chirps.index view after creating the chirp
    return to_route('chirps.index')
        ->with ('status',__('Chirp created successfully!'));

});



// Route::post('/chirps', function ($chirp=null) {
//     return Chirp::create([

//             'message'=> request('message'),
//             'user_id'=> auth()->id(),

//      ]);

//      /* Returns the chirp to the chirps.index view*/
//      return to_route('chirps.index');

// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
