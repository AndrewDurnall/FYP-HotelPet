<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pets')->insert([
            'customer_id' => 1,
            'petName' => "Spot",
            'petAge' => "9",
            'species' => "Cat",
            'breed' => "British Short Hair",
            'vetName' => "Stratnots",
            'vetNumber' => "01425 217891",
            'microChip' => "715321612A",
            'vaccinationDate' => Carbon::parse('2024-01-01'),
            'feedingRequirements' => "Dry food only",
            'avoidedFood' => "Fish",
            'medicationDetails' => "1 Tablet in the morning",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pets')->insert([
            'customer_id' => 2,
            'petName' => "Cricket",
            'petAge' => "5",
            'species' => "Cat",
            'breed' => "British Blue",
            'vetName' => "Highfields",
            'vetNumber' => "01214 513861",
            'vaccinationDate' => Carbon::parse('2023-09-15'),
            'feedingRequirements' => "Wet food only",
            'avoidedFood' => "Turkey",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pets')->insert([
            'customer_id' => 3,
            'petName' => "Cupcake",
            'petAge' => "4",
            'species' => "Cat",
            'breed' => "British Short Hair",
            'vetName' => "Stratnots",
            'vetNumber' => "01425 217891",
            'microChip' => "274322812X",
            'vaccinationDate' => Carbon::parse('2024-01-01'),
            'feedingRequirements' => "None",
            'avoidedFood' => "None",
            'medicationDetails' => "None",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pets')->insert([
            'customer_id' => 4,
            'petName' => "Tigger",
            'petAge' => "2",
            'species' => "Cat",
            'breed' => "Ginger Tabby",
            'vetName' => "Stratnots",
            'vetNumber' => "01425 217891",
            'microChip' => "915725202B",
            'vaccinationDate' => Carbon::parse('2024-01-01'),
            'feedingRequirements' => "Dry food only",
            'avoidedFood' => "None",
            'medicationDetails' => "None",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('pets')->insert([
            'customer_id' => 2,
            'petName' => "Mittens",
            'petAge' => "8",
            'species' => "Cat",
            'breed' => "British Long Hair Tabby",
            'vetName' => "Hardens",
            'vetNumber' => "01422 245212",
            'microChip' => "115421532G",
            'vaccinationDate' => Carbon::parse('2023-12-01'),
            'feedingRequirements' => "None",
            'avoidedFood' => "None",
            'medicationDetails' => "None",
            'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
