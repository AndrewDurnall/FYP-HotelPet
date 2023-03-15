<?php

use App\Http\Controllers\AddCustomerController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PensController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// route for dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// route for bookings
Route::resource('Bookings', BookingsController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

// route for pets
Route::resource('pets', PetsController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

// route for addcustomer
Route::resource('addcustomer', AddCustomerController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

// route for customers
Route::get('/customers', function () {
    return Inertia::render('Customers');
})->middleware(['auth', 'verified'])->name('customers');

// route for calendar
Route::get('/calendar', function () {
    return Inertia::render('Calendar');
})->middleware(['auth', 'verified'])->name('calendar');

// route for bookings
Route::get('/bookings', function () {
    return Inertia::render('Bookings');
})->middleware(['auth', 'verified'])->name('bookings');

// route for new customer view
Route::get('/newcustomer', function () {
    return Inertia::render('NewCustomer');
})->middleware(['auth', 'verified'])->name('newcustomer');

// route for new booking view
Route::get('/newbooking', function () {
    return Inertia::render('NewBooking');
})->middleware(['auth', 'verified'])->name('newbooking');

// route for profile authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');
});

// Customer Viewing And Editing Routes
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index')->middleware('auth');
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create')->middleware('auth');
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store')->middleware('auth');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit')->middleware('auth');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update')->middleware('auth');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy')->middleware('auth');

// Route for when a pet is created with a customer as its owner
Route::get('/customers/{customer}/pets/create', [PetsController::class, 'create'])->name('pets.create')->middleware('auth');

// Pet Editing Routes
Route::get('/pets/{pets}/edit', [PetsController::class, 'edit'])->name('pets.edit')->middleware('auth');
Route::put('/pets/{pets}', [PetsController::class, 'update'])->name('pets.update')->middleware('auth');
Route::delete('/pets/{pets}', [PetsController::class, 'destroy'])->name('pets.destroy')->middleware('auth');

// Bookings Viewing and Editing Routes
Route::get('/bookings', [BookingsController::class, 'index'])->name('bookings.index')->middleware('auth');
Route::post('/bookings', [BookingsController::class, 'store'])->name('bookings.store')->middleware('auth');
Route::get('/newbooking', [BookingsController::class, 'create'])->name('bookings.create')->middleware('auth');
Route::get('/bookings/{id}/edit', [BookingsController::class, 'edit'])->name('bookings.edit')->whereNumber('id')->middleware('auth');
Route::put('/bookings/{booking}', [BookingsController::class, 'update'])->name('bookings.update')->middleware('auth');
Route::delete('/bookings/{bookings}', [BookingsController::class, 'destroy'])->name('bookings.destroy')->middleware('auth');

// Checking Pen Availability
Route::get('/bookings/check', [BookingsController::class, 'checkAvailability'])->name('bookings.checkAvailability')->middleware('auth');
Route::get('/bookings/checkEdit/{id}', [BookingsController::class, 'checkAvailabilityEdit'])->name('bookings.checkAvailabilityEdit')->middleware('auth');

// Route for displaying the calendar view with bookings.
Route::get('/calendar', [BookingsController::class, 'getBookings'])->name('calendar')->middleware('auth');;

// Pen Viewing And Editing Routes
Route::get('/pens', [PensController::class, 'index'])->name('pens.index')->middleware('auth');
Route::get('/pens/create', [PensController::class, 'create'])->name('pens.create')->middleware('auth');
Route::post('/pens', [PensController::class, 'store'])->name('pens.store')->middleware('auth');
Route::get('/pens/{pens}/edit', [PensController::class, 'edit'])->name('pens.edit')->middleware('auth');
Route::put('/pens/{pens}', [PensController::class, 'update'])->name('pens.update')->middleware('auth');
Route::delete('/pens/{pens}', [PensController::class, 'destroy'])->name('pens.destroy')->middleware('auth');

require __DIR__.'/auth.php';
