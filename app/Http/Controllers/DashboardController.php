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
        $pensInUse = DB::table('bookings')
            ->where('startDate', '<=', Carbon::today())
            ->where('endDate', '>=', Carbon::today())
            ->count();

        $pensCount = DB::table('pens')->count();

        $date = Carbon::today()->isoFormat('dddd Do MMMM YYYY');

        return Inertia::render('Dashboard', [
            'pensInUse' => $pensInUse,
            'pensCount' => $pensCount,
            'date' => $date,
        ]);
    }
}
