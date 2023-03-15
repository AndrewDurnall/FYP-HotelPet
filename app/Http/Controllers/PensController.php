<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\pens;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;

class PensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $pens = Pens::all();

        return Inertia::render('Pens/Index', [
            'pens' => $pens,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Pens/Create', [
            //
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'penNumber' => 'required',
            'description' => 'required',

        ]);

        // Create new pen with the data from the pen creation form
        $pens = new Pens();
        $pens->penNumber = $validatedData['penNumber'];
        $pens->description = $validatedData['description'];
        $pens->save();

        return redirect()->route('pens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\pens $pens
     * @return \Illuminate\Http\Response
     */
    public function show(pens $pens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\pens $pens
     * @return \Inertia\Response
     */
    public function edit(pens $pens): \Inertia\Response
    {
        // redirecting user edit form for the pen whose edit button was clicked on
        return Inertia::render('Pens/Edit', [
            'pens' => $pens,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\pens $pens
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, Pens $pens)
    {
        // updating the pen details in the pens table with the request information from the pen edit form
        $pens->update($request->all());

        // redirecting the user to the list of pens via this controllers index function
        return redirect()->route('pens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\pens $pens
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(pens $pens)
    {
        // removing the pen from the database via its penID which is passed via the url routing in web.php
        $pens->delete();

        // redirecting the user to the list of pens via this controllers index function
        return redirect()->route('pens.index');
    }

    public function bookings()
    {
        // returning the pens with the bookings that are attached to them
        return $this->hasMany(Bookings::class);
    }

}
