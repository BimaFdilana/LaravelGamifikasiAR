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
        // Nonaktifkan Foreign Key Check sementara untuk truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('missions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        DB::table('missions')->insert([
            // --- MISI 1: BUKU (Tipe AR Book) ---
            [
                'title' => 'Misi 1: Kunjungi Kampus',
                'description' => 'Temukan buku "Pengantar Koding" di perpustakaan dan scan sampulnya untuk belajar sejarah.',
                'type' => 'book',
                'target_image_name' => 'Image1', // Harus sama dengan nama object di Unity Hierarchy
                'quiz_data' => null,
                'points_reward' => 100,
                'badge_reward_id' => 1, // Pastikan Badge ID 1 ada di tabel badges
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Misi 2: Kunjungi kantin',
                'description' => 'Temukan buku "Pengantar Koding" di perpustakaan dan scan sampulnya untuk belajar sejarah.',
                'type' => 'book',
                'target_image_name' => 'Image2', // Harus sama dengan nama object di Unity Hierarchy
                'quiz_data' => null,
                'points_reward' => 100,
                'badge_reward_id' => 1, // Pastikan Badge ID 1 ada di tabel badges
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'title' => 'Misi 3: Kunjungi pustaka',
                'description' => 'Temukan buku "Pengantar Koding" di perpustakaan dan scan sampulnya untuk belajar sejarah.',
                'type' => 'book',
                'target_image_name' => 'Image3', // Harus sama dengan nama object di Unity Hierarchy
                'quiz_data' => null,
                'points_reward' => 100,
                'badge_reward_id' => 1, // Pastikan Badge ID 1 ada di tabel badges
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Misi 4: Kunjungi Perpustakaangu',
                'description' => 'Temukan buku "Pengantar Koding" di perpustakaan dan scan sampulnya untuk belajar sejarah.',
                'type' => 'book',
                'target_image_name' => 'Image4', // Harus sama dengan nama object di Unity Hierarchy
                'quiz_data' => null,
                'points_reward' => 100,
                'badge_reward_id' => 1, // Pastikan Badge ID 1 ada di tabel badges
                'created_at' => $now,
                'updated_at' => $now,
            ],


            // --- MISI 2: GEDUNG (Tipe AR Building) ---
            [
                'title' => 'Misi 2: Sapa Gedung Utama',
                'description' => 'Cari QR Code atau Marker di pintu masuk Gedung Utama, lalu scan untuk melihat informasi.',
                'type' => 'building',
                'target_image_name' => 'Image2', // Harus sama dengan nama object di Unity Hierarchy
                'quiz_data' => null,
                'points_reward' => 50,
                'badge_reward_id' => 2, // Pastikan Badge ID 2 ada di tabel badges
                'created_at' => $now,
                'updated_at' => $now,
            ],

            // --- MISI 3: KUIS (Tipe Quiz - Tanpa AR) ---
            [
                'title' => 'Misi 3: Pengetahuan Umum Kampus',
                'description' => 'Jawab pertanyaan singkat seputar pimpinan kampus Polbeng.',
                'type' => 'quiz',
                'target_image_name' => null, // Tidak butuh kamera AR
                'quiz_data' => json_encode([
                    'question' => 'Siapakah nama Direktur Politeknik Negeri Bengkalis saat ini?',
                    'options' => [
                        'Bapak Johny Cates', // Opsi A (Index 0)
                        'Bapak Yanuar',      // Opsi B (Index 1)
                        'Ibu Nurul',         // Opsi C (Index 2)
                        'Bapak Ahmad'        // Opsi D (Index 3)
                    ],
                    'correct_index' => 0 // Jawaban benar adalah index 0 (Johny Cates)
                ]),
                'points_reward' => 25,
                'badge_reward_id' => null, // Tidak ada hadiah lencana
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}