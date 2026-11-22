<?php

namespace Database\Seeders;

use App\Models\Mission;
use Illuminate\Database\Seeder;

/**
 * Revisi: pencarian buku diganti pencarian gedung + kuis pengenalan lingkungan kampus.
 * Aman dijalankan ulang (php artisan db:seed --class=MissionSeeder):
 * - misi buku lama dihapus,
 * - misi lain dibuat/diperbarui berdasarkan judul,
 * - progres pengguna untuk misi yang tidak dihapus tetap tersimpan;
 *   misi baru otomatis muncul di akhir daftar setiap pengguna.
 */
class MissionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Hapus misi lama yang sudah tidak dipakai (relasi user_missions ikut terhapus / cascade)
        Mission::where('type', 'book')->get()->each->delete();
        Mission::whereIn('title', ['Misi 2: Sapa Gedung Utama', 'Misi 3: Pengetahuan Umum Kampus'])->get()->each->delete();

        // 2. Pencarian gedung (target bawaan aplikasi: Gedung1-4, lebar cetak 0,5 m)
        $gedung = [
            ['Temukan Gedung Teknik Elektro', 'Gedung1', 1,
                'Cari Gedung Teknik Elektro. Perpustakaan Polbeng juga berada di gedung ini, di sisi kanan bila dilihat dari jalan utama. Pindai penanda gedung untuk menyelesaikan misi.'],
            ['Temukan Gedung Direktorat (BAAK)', 'Gedung2', 2,
                'Cari gedung utama Polbeng, tempat bagian administrasi dan staf (BAAK). Pindai penanda gedung untuk menyelesaikan misi.'],
            ['Temukan Gedung Teknik Informatika', 'Gedung3', 3,
                'Cari Gedung Jurusan Teknik Informatika. Pindai penanda gedung untuk menyelesaikan misi.'],
            ['Temukan Gedung Administrasi Niaga', 'Gedung4', null,
                'Cari Gedung Jurusan Administrasi Niaga. Pindai penanda gedung untuk menyelesaikan misi.'],
        ];
        foreach ($gedung as [$title, $target, $badge, $desc]) {
            Mission::updateOrCreate(['title' => $title], [
                'description' => $desc,
                'type' => 'building',
                'target_image_name' => $target,
                'target_width' => 0.5,
                'quiz_data' => null,
                'points_reward' => 50,
                'badge_reward_id' => $badge,
            ]);
        }

        // 3. Kuis pengenalan lingkungan kampus (1 pertanyaan per misi)
        //    Jawaban bertanda (*) berasal dari tata letak peta yang dikonfirmasi pengembang; mohon dicek ulang.
        $kuis = [
            ['Kuis: Tetangga Gedung Elektro', 'Gedung jurusan apa yang letaknya di sebelah Gedung Teknik Elektro?',
                ['Teknik Informatika', 'Teknik Mesin', 'Bahasa', 'Administrasi Niaga'], 0], // (*)
            ['Kuis: Seberang Gedung Utama', 'Gedung utama (BAAK) berseberangan dengan gedung jurusan apa?',
                ['Teknik Elektro', 'Teknik Informatika', 'Teknik Mesin', 'Bahasa'], 0], // (*)
            ['Kuis: Letak Perpustakaan', 'Perpustakaan Polbeng berada di gedung apa?',
                ['Gedung Teknik Elektro', 'Gedung Teknik Informatika', 'Gedung C', 'Gedung GKT 4'], 0],
            ['Kuis: Fungsi Gedung Utama', 'Gedung utama Polbeng yang menjadi pusat administrasi dan staf adalah...',
                ['BAAK (Gedung Direktorat)', 'Gedung C', 'Gedung GKT 4', 'Gedung Bahasa'], 0],
            ['Kuis: Di Belakang BAAK', 'Gedung apa yang berada tepat di belakang BAAK?',
                ['Gedung C', 'Gedung Bahasa', 'Gedung Teknik Elektro', 'Gedung Mesin'], 0],
            ['Kuis: Sebelah Kiri BAAK', 'Jika dilihat dari jalan utama, gedung apa yang berada di sebelah kiri BAAK?',
                ['Gedung GKT 4', 'Gedung Bahasa', 'Gedung C', 'Perpustakaan'], 0],
            ['Kuis: Sebelah Kanan BAAK', 'Jika dilihat dari jalan utama, gedung apa yang berada di sebelah kanan BAAK?',
                ['Gedung Bahasa', 'Gedung GKT 4', 'Gedung Teknik Informatika', 'Gedung Mesin'], 0],
            ['Kuis: Letak Musholla', 'Musholla berada di gedung apa?',
                ['Gedung GKT 4', 'Gedung C', 'BAAK', 'Gedung Bahasa'], 0],
            ['Kuis: Lab Komputer', 'Lab Komputer berada di gedung apa?',
                ['Gedung C', 'Gedung GKT 4', 'Gedung Bahasa', 'BAAK'], 0],
            ['Kuis: Ruang C9', 'Ruang C9 di Gedung C berada di lantai berapa?',
                ['Lantai 2', 'Lantai 1', 'Lantai 3', 'Lantai 4'], 0],
            ['Kuis: Direktur Polbeng', 'Siapakah Direktur Politeknik Negeri Bengkalis saat ini?',
                ['Johny Custer', 'Bapak Yanuar', 'Ibu Nurul', 'Bapak Ahmad'], 0],
        ];
        foreach ($kuis as [$title, $question, $answers, $correct]) {
            // acak urutan jawaban supaya jawaban benar tidak selalu di posisi pertama
            $correctText = $answers[$correct];
            shuffle($answers);
            $correct = array_search($correctText, $answers, true);
            Mission::updateOrCreate(['title' => $title], [
                'description' => 'Jawab pertanyaan seputar lingkungan kampus Polbeng.',
                'type' => 'quiz',
                'target_image_name' => null,
                'quiz_data' => ['question' => $question, 'answers' => $answers, 'correct_index' => $correct],
                'points_reward' => 25,
                'badge_reward_id' => null,
            ]);
        }
    }
}
