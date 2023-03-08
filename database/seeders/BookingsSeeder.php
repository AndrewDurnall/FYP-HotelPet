<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Pen 6 available

        DB::table('bookings')->insert([
            'pens_id' => 1,
            'customer_id' => 1,
            'startDate' => Carbon::parse('2023-04-05'),
            'endDate' => Carbon::parse('2023-04-10'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 1,
            'customer_id' => 2,
            'startDate' => Carbon::parse('2023-04-11'),
            'endDate' => Carbon::parse('2023-04-15'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 2,
            'customer_id' => 4,
            'startDate' => Carbon::parse('2023-04-11'),
            'endDate' => Carbon::parse('2023-04-16'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 3,
            'customer_id' => 3,
            'startDate' => Carbon::parse('2023-04-05'),
            'endDate' => Carbon::parse('2023-04-16'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);

        DB::table('bookings')->insert([
            'pens_id' => 6,
            'customer_id' => 3,
            'startDate' => Carbon::parse('2023-03-20'),
            'endDate' => Carbon::parse('2023-04-30'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);

        //Fully booked from 10th to 19th March 2023 for testing.
        DB::table('bookings')->insert([
            'pens_id' => 1,
            'customer_id' => 1,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 2,
            'customer_id' => 2,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 3,
            'customer_id' => 3,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 4,
            'customer_id' => 4,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 5,
            'customer_id' => 1,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 6,
            'customer_id' => 2,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 7,
            'customer_id' => 3,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 8,
            'customer_id' => 4,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 9,
            'customer_id' => 1,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 10,
            'customer_id' => 2,
            'startDate' => Carbon::parse('2023-03-10'),
            'endDate' => Carbon::parse('2023-03-19'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);

        //Pen 6 is only pen available from 1st to 4th March 2023.
        DB::table('bookings')->insert([
            'pens_id' => 1,
            'customer_id' => 1,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 2,
            'customer_id' => 2,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 3,
            'customer_id' => 3,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 4,
            'customer_id' => 4,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 5,
            'customer_id' => 1,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 7,
            'customer_id' => 2,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 8,
            'customer_id' => 3,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 9,
            'customer_id' => 4,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('bookings')->insert([
            'pens_id' => 10,
            'customer_id' => 1,
            'startDate' => Carbon::parse('2023-03-01'),
            'endDate' => Carbon::parse('2023-03-04'),
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);

    }
}
