<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'id' => 1,
                'name' => 'Perpustakaan Polbeng',
                'description' => 'Gedung pusat perpustakaan dan referensi.',
                'marker_id' => 'marker_perpustakaan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Gedung Utama',
                'description' => 'Gedung rektorat dan administrasi.',
                'marker_id' => 'marker_gedung_utama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}