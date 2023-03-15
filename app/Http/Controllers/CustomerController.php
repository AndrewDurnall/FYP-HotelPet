<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index()
    {
        // gets the customers details with their associated pets
        $customers = Customer::with('pets')->get();

        // for each customer the associated pet details are attained
        foreach ($customers as $customer) {
            $customer->load('pets');
        }

        // user is shown the list of customers with the associated pets.
        return Inertia::render('Customers/Index', [
            'customers' => $customers,
        ]);
    }

    public function edit(Customer $customer)
    {
        // returns user to the customer edit form with the customer details
        return Inertia::render('Customers/Edit', [
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        // updating the customer details from the form sent via the request.
        $customer->update($request->all());

        // redirecting user to the list of customers via the index function of this controller
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        // removes the customer via the customer id that is passed via the route in web.php
        $customer->delete();

        // redirecting user to the list of customers via the index function of this controller
        return redirect()->route('customers.index')->with('Customer deleted successfully.');
    }

    public function pet(Customer $customer)
    {
        // Load the customer's pets using the relationship defined in the Customer model
        $customer->load('pets');

        // Return the Inertia component with the customer and their pets data
        return Inertia::render('Customers/Index', [
            'customer' => $customer,
            'pets' => $customer->pets,
        ]);
    }

}
