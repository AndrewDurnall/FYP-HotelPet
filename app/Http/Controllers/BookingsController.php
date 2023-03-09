<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bookings;
use App\Models\Customer;
use App\Models\pens;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $bookings = Bookings::with('pens', 'customer')->get();

        return Inertia::render('Bookings/Index', [
            'bookings' => $bookings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $pens = Pens::all();
        $bookings = Bookings::with('pens')->get();
        return Inertia::render('Bookings/Create', [
            'customers' => $customers,
            'booking' => $bookings,
            'pens' => $pens
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'pens_id' => 'required',
            'customer_id' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',

        ]);

        // Create new booking with the data
        $booking = new Bookings();
        $booking->pens_id = $validatedData['pens_id'];
        $booking->customer_id = $validatedData['customer_id'];
        $booking->startDate = $validatedData['startDate'];
        $booking->endDate = $validatedData['endDate'];
        $booking->save();

        // Redirect to the view bookings page
        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return Response
     */
    public function show(Bookings $bookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $customers = Customer::all();
        $booking = Bookings::with('pens', 'customer')->findOrFail($id);
        return Inertia::render('Bookings/Edit', [
            'booking' => $booking,
            'customers' => $customers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Bookings $booking)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'pens_id' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
        ]);
        $booking->customer_id = $validatedData['customer_id'];
        $booking->pens_id = $validatedData['pens_id'];
        $booking->startDate = $validatedData['startDate'];
        $booking->endDate = $validatedData['endDate'];
        $booking->save();

        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookings  $bookings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Bookings $bookings)
    {
        $bookings->delete();
        return redirect()->route('bookings.index')->with('Booking deleted successfully.');
    }

    public function checkAvailability(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Get all pens that are not booked for the selected date range database query.
        $pens = Pens::whereDoesntHave('bookings', function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                // Check for bookings that start within the selected date range or overlap with it.
                $query->where('startDate', '>=', $startDate)
                    ->where('startDate', '<', $endDate);
            })->orWhere(function ($query) use ($startDate, $endDate) {
                // Check for bookings that end within the selected date range or overlap with it.
                $query->where('endDate', '>', $startDate)
                    ->where('endDate', '<=', $endDate);
            })->orWhere(function ($query) use ($startDate, $endDate) {
                // Check for bookings that are fully encompassed within the date range.
                $query->where('startDate', '<', $startDate)
                    ->where('endDate', '>', $endDate);
            });
        })->get();

        $available = $pens->count() > 0;
                // Returning a JSON with available pens within the selected date range.
        return response()->json([
            'available' => $available,
            'pens' => $pens
        ]);

    }

    public function checkAvailabilityEdit(Request $request, $id)
    {

        $booking = Bookings::findOrFail($id);
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Get all pens that are not booked for the selected date range.
        $pens = Pens::whereDoesntHave('bookings', function ($query) use ($startDate, $endDate, $booking) {
            $query->where('id', '<>', $booking->id)
                ->where(function ($query) use ($startDate, $endDate) {
                    // Check for bookings that start within the selected date range or overlap with it.
                    $query->where('startDate', '>=', $startDate)
                        ->where('startDate', '<', $endDate);
                })->orWhere(function ($query) use ($startDate, $endDate) {
                    // Check for bookings that end within the selected date range or overlap with it.
                    $query->where('endDate', '>', $startDate)
                        ->where('endDate', '<=', $endDate);
                })->orWhere(function ($query) use ($startDate, $endDate) {
                    // Check for bookings that are fully encompassed within the date range.
                    $query->where('startDate', '<', $startDate)
                        ->where('endDate', '>', $endDate);
                });
        })->get();

        // Check if the pen attached to the booking is available for the selected date range.
        $penAvailable = !Pens::whereHas('bookings', function ($query) use ($startDate, $endDate, $booking) {
            $query->where('id', '<>', $booking->id)
                ->where(function ($query) use ($startDate, $endDate) {
                    // Check for bookings that start within the selected date range or overlap with it.
                    $query->where('startDate', '>=', $startDate)
                        ->where('startDate', '<', $endDate);
                })->orWhere(function ($query) use ($startDate, $endDate) {
                    // Check for bookings that end within the selected date range or overlap with it.
                    $query->where('endDate', '>', $startDate)
                        ->where('endDate', '<=', $endDate);
                })->orWhere(function ($query) use ($startDate, $endDate) {
                    // Check for bookings that are fully encompassed within the date range.
                    $query->where('startDate', '<', $startDate)
                        ->where('endDate', '>', $endDate);
                });
        })->where('id', $booking->pen_id)->exists();

        $available = $pens->count() > 0 && $penAvailable;

        // Returning a JSON with available pens within the selected date range.
        return response()->json([
            'available' => $available,
            'pens' => $pens
        ]);
    }

    // this function was intended to get the booking info to use in an event calendar, the info is
    // listed as pens with bookings with a start and end date and with the name of the customer that is booked.
    public function getBookings()
    {
        $bookings = Bookings::with('pens', 'customer')->get();
        $pens = Pens::all();

        return Inertia::render('Calendar', [
            'bookings' => $bookings,
            'pens' => $pens
        ]);
    }

}
