<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::with('badge')->latest()->paginate(10);
        return view('admin.missions.index', compact('missions'));
    }

    public function create()
    {
        $badges = Badge::all();
        return view('admin.missions.create', compact('badges'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $this->handleUploads($request, $data);
        $this->ensureTarget($data);

        Mission::create($data);

        return redirect()->route('admin.missions.index')
            ->with('success', 'Misi berhasil ditambahkan. Misi baru otomatis muncul di aplikasi semua pengguna.');
    }

    public function edit(Mission $mission)
    {
        $badges = Badge::all();
        return view('admin.missions.edit', compact('mission', 'badges'));
    }

    public function update(Request $request, Mission $mission)
    {
        $data = $this->validated($request);
        $this->handleUploads($request, $data, $mission);
        $this->ensureTarget($data, $mission);

        $mission->update($data);

        return redirect()->route('admin.missions.index')
            ->with('success', 'Misi berhasil diperbarui.');
    }

    public function destroy(Mission $mission)
    {
        $this->deleteFile($mission->target_image_path);
        $this->deleteFile($mission->cover_image_path);
        $mission->delete();

        return redirect()->route('admin.missions.index')
            ->with('success', 'Misi berhasil dihapus.');
    }

    // ------------------------------------------------------------------

    private function validated(Request $request): array
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:building,quiz,book',
            'description' => 'required|string',
            'target_image_name' => 'nullable|string|max:255',
            'target_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'target_width' => 'nullable|numeric|min:0.05|max:10',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'quiz_data' => 'nullable|required_if:type,quiz|json',
            'points_reward' => 'required|integer|min:0',
            'badge_reward_id' => 'nullable|exists:badges,id',
        ], [
            'target_image.max' => 'Ukuran gambar target maksimal 5 MB.',
            'cover_image.max' => 'Ukuran gambar sampul maksimal 5 MB.',
            'quiz_data.required_if' => 'Pertanyaan kuis wajib diisi untuk tipe Kuis.',
        ]);

        $data = $request->only([
            'title', 'type', 'description', 'target_image_name', 'target_width',
            'quiz_data', 'points_reward', 'badge_reward_id',
        ]);

        if ($data['type'] === 'quiz') {
            $data['target_image_name'] = null;
            $data['target_width'] = null;
        } else {
            $data['quiz_data'] = null;
        }
        return $data;
    }

    private function handleUploads(Request $request, array &$data, ?Mission $mission = null): void
    {
        if ($request->boolean('remove_target_image') && $mission) {
            $this->deleteFile($mission->target_image_path);
            $data['target_image_path'] = null;
        }
        if ($request->boolean('remove_cover_image') && $mission) {
            $this->deleteFile($mission->cover_image_path);
            $data['cover_image_path'] = null;
        }
        if ($request->hasFile('target_image')) {
            if ($mission) $this->deleteFile($mission->target_image_path);
            $data['target_image_path'] = $this->storeFile($request->file('target_image'), 'target');
        }
        if ($request->hasFile('cover_image')) {
            if ($mission) $this->deleteFile($mission->cover_image_path);
            $data['cover_image_path'] = $this->storeFile($request->file('cover_image'), 'cover');
        }
    }

    /** Misi AR wajib punya gambar target yang di-upload ATAU nama target bawaan aplikasi. */
    private function ensureTarget(array &$data, ?Mission $mission = null): void
    {
        if ($data['type'] === 'quiz') return;

        $hasUpload = array_key_exists('target_image_path', $data)
            ? !empty($data['target_image_path'])
            : ($mission && !empty($mission->target_image_path));

        if (!$hasUpload && empty($data['target_image_name'])) {
            throw ValidationException::withMessages([
                'target_image' => 'Misi AR wajib memiliki gambar target (upload) atau nama target bawaan aplikasi.',
            ]);
        }
        if ($hasUpload && empty($data['target_width'])) {
            $data['target_width'] = 0.5; // default lebar cetak 50 cm
        }
    }

    private function storeFile(UploadedFile $file, string $prefix): string
    {
        $dir = public_path(Mission::UPLOAD_DIR);
        File::ensureDirectoryExists($dir);
        $name = $prefix . '_' . now()->format('YmdHis') . '_' . Str::random(6) . '.' . strtolower($file->getClientOriginalExtension());
        $file->move($dir, $name);
        return Mission::UPLOAD_DIR . '/' . $name;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && str_starts_with($path, Mission::UPLOAD_DIR) && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
