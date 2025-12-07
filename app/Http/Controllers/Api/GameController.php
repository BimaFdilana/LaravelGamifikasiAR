<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Location;
use App\Models\Mission;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Mengambil daftar misi.
     * JIKA user belum punya history misi, sistem akan mengacak urutan (Randomizer)
     * lalu menyimpannya ke database user tersebut.
     */
    public function getMissions(Request $request)
    {
        $user = $request->user();

        // 1. CEK: Apakah user ini sudah punya urutan misi di database?
        // Jika count == 0, berarti dia user baru atau belum pernah buka menu misi.
        if ($user->missions()->count() === 0) {
            $this->generateRandomMissionsForUser($user);
        }

        // 2. AMBIL: Ambil data dari relasi user->missions
        // Laravel otomatis mengurutkan berdasarkan 'order' di tabel pivot
        // (Pastikan Anda sudah update Model User.php seperti langkah sebelumnya)
        $missions = $user->missions()->with('badge')->get();

        return response()->json($missions);
    }

    /**
     * Logic Pengacakan Soal (Private)
     */
    private function generateRandomMissionsForUser($user)
    {
        // A. Ambil misi per kategori dan ACAK urutannya
        $books = Mission::where('type', 'book')->inRandomOrder()->get();
        $buildings = Mission::where('type', 'building')->inRandomOrder()->get();
        $quizzes = Mission::where('type', 'quiz')->inRandomOrder()->get();

        // B. Gabungkan: Buku -> Gedung -> Kuis (Isi per kategori sudah acak)
        $finalSequence = $books->merge($buildings)->merge($quizzes);

        $syncData = [];
        $order = 1;

        foreach ($finalSequence as $mission) {
            // Misi urutan pertama (1) statusnya 'in_progress' agar tombol MULAI muncul di Unity
            // Sisanya 'locked'
            $status = ($order === 1) ? 'in_progress' : 'locked';

            $syncData[$mission->id] = [
                'order' => $order,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $order++;
        }

        // C. Simpan ke tabel pivot user_missions sekaligus
        $user->missions()->attach($syncData);
    }

    // --- Method Lain Tetap Sama ---

    public function getMissionDetail(Mission $mission)
    {
        $mission->load('badge');
        return response()->json($mission);
    }

    public function getBadges()
    {
        $badges = Badge::all();
        return response()->json($badges);
    }

    public function getLocations()
    {
        $locations = Location::all();
        return response()->json($locations);
    }
}