<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'firstName' => "Andrew",
            'lastName' => "Durnall",
            'houseNumberOrName' => "14",
            'addressLine1' => "Forrest Street",
            'addressLine2' => "Palace View",
            'townCity' => "Stafford",
            'telephone' => "01897 258741",
            'postCode' => "ST45 8TE",
            'email' => "andy@internet.com",
            'emergencyName' => "Nigel Lemingworth",
            'emergencyNumber' => "01765 654789",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('customers')->insert([
            'firstName' => "John",
            'lastName' => "Smith",
            'houseNumberOrName' => "64",
            'addressLine1' => "Zoo Lane",
            'addressLine2' => "Lower Hampton Road",
            'townCity' => "Hampton",
            'telephone' => "09878 787324",
            'postCode' => "HM65 4FR",
            'email' => "john@internet.com",
            'emergencyName' => "Sarah Cathoway",
            'emergencyNumber' => "01361 765782",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('customers')->insert([
            'firstName' => "Sally",
            'lastName' => "Carthy",
            'houseNumberOrName' => "12",
            'addressLine1' => "Orchard View",
            'addressLine2' => "Upper Sky",
            'townCity' => "Salisbury",
            'telephone' => "02756 946235",
            'postCode' => "SA72 9UF",
            'email' => "sally@bt.com",
            'emergencyName' => "Gwen McCarthy",
            'emergencyNumber' => "02435 143778",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('customers')->insert([
            'firstName' => "Luna",
            'lastName' => "Lovett",
            'houseNumberOrName' => "100",
            'addressLine1' => "Peace Street",
            'addressLine2' => "Luxury Way",
            'townCity' => "Heavenswich",
            'telephone' => "01876 632743",
            'postCode' => "HW13 3RS",
            'email' => "luna@skynet.com",
            'emergencyName' => "Harrold Lovett",
            'emergencyNumber' => "01879 465825",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }

}
