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
        // Collecting all bookings with their related pen and customer
        $bookings = Bookings::with('pens', 'customer')->get();

        // returning the user to the list of bookings
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
        //Fetching all the customers for the dropdown list.
        $customers = Customer::all();
        //Fetching all the pens for the dropdown list.
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

        // Create new booking with the data from the form
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
        // sending customer details to the edit form
        $customers = Customer::all();

        // sending the booking details with relations of pen and customer to the edit form
        $booking = Bookings::with('pens', 'customer')->findOrFail($id);

        // showing the edit form with the above bookings and customers data
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
        //validating the booking data when passed into the database and making sure end date is after start date.
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'pens_id' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
        ]);

        // assigning the data that is passed from the form on the bookings edit page to the above validators.
        $booking->customer_id = $validatedData['customer_id'];
        $booking->pens_id = $validatedData['pens_id'];
        $booking->startDate = $validatedData['startDate'];
        $booking->endDate = $validatedData['endDate'];
        $booking->save();

        // returns the user to the bookings list via this controllers index function.
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
        // this deletes the booking with the id that is passed via the url from the web.php route
        $bookings->delete();

        // returns the user to the list of bookings via the index function in this controller.
        return redirect()->route('bookings.index');
    }

    // this function is for when a user is creating a new booking and queries the available dates
    public function checkAvailability(Request $request)
    {
        // getting the start date from the new booking form
        $startDate = $request->input('startDate');
        // getting the end date from the new booking form
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

    // this function is for when a user is editing a booking and queries the available dates
    public function checkAvailabilityEdit(Request $request, $id)
    {
        // getting the booking data via the find or fail method on the booking id passed from the route in web.php
        $booking = Bookings::findOrFail($id);
        // getting the start date from the booking edit form
        $startDate = $request->input('startDate');
        // getting the end date from the booking edit form
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

                })->orWhere(function ($query) use ($startDate, $endDate) {
                    // Check for bookings that are within the original date range.
                    $query->where('startDate', '>', $startDate)
                        ->where('endDate', '<', $endDate);
                });
        })->where('id', $booking->pen_id)->exists();

        $available = $pens->count() > 0 && $penAvailable;

        // Returning a JSON with available pens within the selected date range.
        return response()->json([
            'available' => $available,
            'pens' => $pens
        ]);
    }

    // this function sends the required data for bookings and pens and customers to the Calendar page to display them in the calendar view.
    public function getBookings()
    {
        // gets the bookings data with associated pen and customer
        $bookings = Bookings::with('pens', 'customer')->get();

        // gets the pens from the database to use to create the vertical axis of the calendar view
        $pens = Pens::all();

        // returns the view of the calendar component with the above booking and pens data.
        return Inertia::render('Calendar', [
            'bookings' => $bookings,
            'pens' => $pens
        ]);
    }

}
