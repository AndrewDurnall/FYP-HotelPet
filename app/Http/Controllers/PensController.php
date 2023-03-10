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
        $pens->update($request->all());
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
        $pens->delete();
        return redirect()->route('pens.index')->with('Pen deleted successfully.');
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public function scopeAvailableBetween($query, $start, $end)
    {
        return $query->whereDoesntHave('bookings', function ($query) use ($start, $end) {
            $query->where('start_date', '<', $end)
                ->where('end_date', '>', $start);
        });
    }
}
