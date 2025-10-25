<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('badges')->insert([
            [
                'id' => 1,
                'name' => 'Ahli Perpustakaan',
                'icon_url' => 'https://cdn-icons-png.flaticon.com/512/224/224598.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Penjelajah Gedung Utama',
                'icon_url' => 'https://cdn-icons-png.flaticon.com/512/190/190313.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Pejuang AR',
                'icon_url' => 'https://cdn-icons-png.flaticon.com/512/8116/8116016.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}