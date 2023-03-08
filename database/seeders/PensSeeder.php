<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pens')->insert([
            'penNumber' => 1,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 2,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 3,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 4,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 5,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 6,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 7,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 8,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 9,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pens')->insert([
            'penNumber' => 10,
            'description' => "Cat Chalet",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
