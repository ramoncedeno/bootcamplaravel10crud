<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index');
        
        
    }

    public function dashboard()
    {
        return view('dashboard');       
        
    }


    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Create the chirp with the provided data
        $chirp = Chirp::create([
            'message' => $request->get('message'),
            'user_id' => auth()->id(),
        ]);

        // // allows to validate the user session (other form)
        //  session()->flash('status','Chirp created successfully!');

        // Redirect to the chirps.index view after creating the chirp
        return to_route('chirps.index')
            ->with ('status',__('Chirp created successfully!'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
