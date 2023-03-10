<?php

namespace App\Http\Controllers;
use App\Models\Pens;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        //Returning a database query for all pens which are being used today
        $pensInUse = DB::table('bookings')
            ->where('startDate', '<=', Carbon::today())
            ->where('endDate', '>=', Carbon::today())
            ->count();

        // Counting the total amount of pens registered in the pens table
        $pensCount = DB::table('pens')->count();

        // Today's date formatted to Day then date
        $date = Carbon::today()->isoFormat('dddd Do MMMM YYYY');

        //Sending the Date, the Total Pens and currently used pens to the dashboard view
        return Inertia::render('Dashboard', [
            'pensInUse' => $pensInUse,
            'pensCount' => $pensCount,
            'date' => $date,
        ]);
    }
}
