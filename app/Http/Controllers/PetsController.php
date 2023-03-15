<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pets;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //getting all the customers for the adding of a pet to a customer with the "add pet" form
        $customers = Customer::all();

        //showing the form to add new pet to a registered customer with the above customer details
        return Inertia::render('AddPet', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, Customer $customer): \Illuminate\Http\RedirectResponse
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'petName' => 'required|string|max:255',
            'petAge' => 'required|integer',
            'species' => 'nullable|string|max:255',
            'breed' => 'nullable|string|max:255',
            'vetName' => 'nullable|string|max:255',
            'vetNumber' => 'nullable|string|max:255',
            'microChip' => 'nullable|string|max:255',
            'vaccinationDate' => 'nullable|string|max:255',
            'feedingRequirements' => 'nullable|string|max:255',
            'avoidedFood' => 'nullable|string|max:255',
            'medicationDetails' => 'nullable|string|max:255',
        ]);

        // Create new pet with the validated data
        $pet = new Pets;
        $pet->petName = $request->petName;
        $pet->petAge = $request->petAge;
        $pet->species = $request->species;
        $pet->breed = $request->breed;
        $pet->vetName = $request->vetName;
        $pet->vetNumber = $request->vetNumber;
        $pet->microChip = $request->microChip;
        $pet->vaccinationDate = $request->vaccinationDate;
        $pet->feedingRequirements = $request->feedingRequirements;
        $pet->avoidedFood = $request->avoidedFood;
        $pet->medicationDetails = $request->medicationDetails;

        $customer = Customer::find($request->input('customer_id'));
        $customer->pets()->save($pet);

        // Redirect to the customers page via the index method of this controller
        return redirect()->route('customers.index')->with('success', 'Pet created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pets  $pets
     * @return \Illuminate\Http\Response
     */
    public function show(Pets $pets)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pets  $pets
     * @return \Inertia\Response
     */
    public function edit(Pets $pets)
    {
        // displays the edit vue component with the pets details for the pet via the id sent with the web.php routing
        return Inertia::render('Pets/Edit', [
                    'pets' => $pets,
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Pets  $pets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pets $pets)
    {
        // updates the pet in the pets table access via the pet id sent via url routing in web.php
        $pets->update($request->all());

        // Redirect to the customers page via the index method of this controller
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pets  $pets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pets $pets)
    {
        // removes the pet from the pets table access via the pet id sent via routing in web.php
        $pets->delete();

        // Redirect to the customers page via the index method of this controller
        return redirect()->route('customers.index')->with('Pet deleted successfully.');
    }
}
