<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('missions')->insert([
            [
                'id' => 1,
                'title' => 'Misi 1: Kunjungi Perpustakaan',
                'description' => 'Temukan marker AR di depan perpustakaan dan scan untuk mempelajari sejarahnya.',
                'points_reward' => 100,
                'badge_reward_id' => 1, // ID 'Ahli Perpustakaan'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'title' => 'Misi 2: Sapa Gedung Utama',
                'description' => 'Cari tahu fakta menarik tentang Gedung Utama dengan scan marker di dekat pintu masuk.',
                'points_reward' => 50,
                'badge_reward_id' => 2, // ID 'Penjelajah Gedung Utama'
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'title' => 'Misi 3: Kuis Kilat Aula',
                'description' => 'Jawab kuis singkat tentang fasilitas Aula.',
                'points_reward' => 25,
                'badge_reward_id' => null, // Tidak ada hadiah lencana
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
