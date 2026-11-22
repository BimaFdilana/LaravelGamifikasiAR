<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Penanda (image target) untuk navigasi indoor di aplikasi AR.
 * Nama kunci harus sama dengan KampusAnchor.imageName di prefab Unity dan nama gambar di Reference Image Library.
 * Urutan array = urutan halaman di Penanda_Navigasi_Polbeng.pdf.
 */
class MarkerController extends Controller
{
    public const SIZE_CM = 18;
    public const HEIGHT_M = 1.5;

    public const MARKERS = [
        'Target_GedungTI' => [
            'judul' => 'Gedung Teknik Informatika',
            'lokasi' => 'Dinding luar Gedung TI, di samping pintu utara (menghadap jalan utama).',
        ],
        'Target_GedungElektro' => [
            'judul' => 'Gedung Teknik Elektro',
            'lokasi' => 'Dinding luar Gedung Teknik Elektro (termasuk Perpustakaan), sisi yang menghadap jalan utama, dekat pintu masuk.',
        ],
        'Target_GKT4' => [
            'judul' => 'Gedung GKT 4',
            'lokasi' => 'Dinding ujung timur GKT 4, di samping pintu utama.',
        ],
        'Target_BAAK' => [
            'judul' => 'BAAK (Gedung Direktorat)',
            'lokasi' => 'Fasad depan BAAK, di samping pintu utama.',
        ],
        'Target_Bahasa' => [
            'judul' => 'Gedung Bahasa',
            'lokasi' => 'Dinding ujung barat Gedung Bahasa, di samping pintu utama.',
        ],
        'Target_GedungC' => [
            'judul' => 'Gedung C',
            'lokasi' => 'Dinding depan blok tengah Gedung C, di samping pintu lobi.',
        ],
        'Target_Mesin' => [
            'judul' => 'Gedung Mesin',
            'lokasi' => 'Dinding timur Gedung Mesin, di samping pintu.',
        ],
    ];

    public function index()
    {
        $markers = [];
        $halaman = 1;
        foreach (self::MARKERS as $nama => $data) {
            $markers[$nama] = $data + ['halaman' => $halaman++];
        }

        return view('admin.markers.index', [
            'markers' => $markers,
            'sizeCm' => self::SIZE_CM,
            'heightM' => self::HEIGHT_M,
        ]);
    }

    /** Lembar cetak A4, satu halaman per penanda (dibuka di browser, bisa langsung ke halaman tertentu: #page=N). */
    public function sheet(): BinaryFileResponse
    {
        return response()->file(resource_path('penanda/Penanda_Navigasi_Polbeng.pdf'), [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Penanda_Navigasi_Polbeng.pdf"',
        ]);
    }

    /** Gambar asli (1024 px) persis seperti yang terdaftar di Reference Image Library. */
    public function image(string $name): BinaryFileResponse
    {
        abort_unless(array_key_exists($name, self::MARKERS), 404);

        return response()->download(resource_path("penanda/png/{$name}.png"), "{$name}.png", [
            'Content-Type' => 'image/png',
        ]);
    }

    /** Pratinjau kecil untuk halaman daftar. */
    public function preview(string $name): BinaryFileResponse
    {
        abort_unless(array_key_exists($name, self::MARKERS), 404);

        return response()->file(resource_path("penanda/thumb/{$name}.jpg"), [
            'Content-Type' => 'image/jpeg',
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }
}
