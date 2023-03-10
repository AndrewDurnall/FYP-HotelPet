<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Contracts\Service\Attribute\Required;

class AddCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('NewCustomer', [
            //
        ]);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->firstName = $request->firstName;
        $customer->lastName = $request->lastName;
        $customer->houseNumberOrName = $request->houseNumberOrName;
        $customer->addressLine1 = $request->addressLine1;
        $customer->addressLine2 = $request->addressLine2;
        $customer->townCity = $request->townCity;
        $customer->postCode = $request->postCode;
        $customer->telephone = $request->telephone;
        $customer->email = $request->email;
        $customer->emergencyName = $request->emergencyName;
        $customer->emergencyNumber = $request->emergencyNumber;
        $customer->save();

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddCustomer  $addCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(AddCustomer $addCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddCustomer  $addCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(AddCustomer $addCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddCustomer  $addCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddCustomer $addCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddCustomer  $addCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddCustomer $addCustomer)
    {
        //
    }
}
