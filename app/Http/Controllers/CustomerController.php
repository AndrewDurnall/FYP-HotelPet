<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('pets')->get();

        foreach ($customers as $customer) {
            $customer->load('pets');
        }
        return Inertia::render('Customers/Index', [
            'customers' => $customers,
        ]);
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Customers/Edit', [
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
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
