<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\pens;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pens  $pens
     * @return \Illuminate\Http\Response
     */
    public function show(pens $pens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pens  $pens
     * @return \Illuminate\Http\Response
     */
    public function edit(pens $pens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pens  $pens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pens $pens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pens  $pens
     * @return \Illuminate\Http\Response
     */
    public function destroy(pens $pens)
    {
        //
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
