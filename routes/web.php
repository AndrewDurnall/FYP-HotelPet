<?php

use App\Http\Controllers\AddCustomerController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CustomerController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('Bookings', BookingsController::class)

    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::resource('pets', PetsController::class)

    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::resource('addcustomer', AddCustomerController::class)

    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);


Route::get('/customers', function () {
    return Inertia::render('Customers');
})->middleware(['auth', 'verified'])->name('customers');

Route::get('/calendar', function () {
    return Inertia::render('Calendar');
})->middleware(['auth', 'verified'])->name('calendar');

Route::get('/bookings', function () {
    return Inertia::render('Bookings');
})->middleware(['auth', 'verified'])->name('bookings');

Route::get('/newcustomer', function () {
    return Inertia::render('NewCustomer');
})->middleware(['auth', 'verified'])->name('newcustomer');

Route::get('/newbooking', function () {
    return Inertia::render('NewBooking');
})->middleware(['auth', 'verified'])->name('newbooking');

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


Route::get('/calendar', [BookingsController::class, 'getBookings'])->name('calendar');


require __DIR__.'/auth.php';
