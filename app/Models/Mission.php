<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mission extends Model
{
    use HasFactory;

    /** Folder upload di dalam public/ (tidak butuh php artisan storage:link). */
    public const UPLOAD_DIR = 'uploads/missions';

    protected $fillable = [
        'title',
        'description',
        'type',
        'target_image_name',
        'target_image_path',
        'target_width',
        'cover_image_path',
        'quiz_data',
        'points_reward',
        'badge_reward_id',
    ];

    protected $casts = [
        'quiz_data' => 'array',
        'target_width' => 'float',
    ];

    /** Ikut dikirim di API supaya aplikasi bisa mengunduh gambar. */
    protected $appends = ['target_image_url', 'cover_image_url', 'type_label'];

    public const TYPE_LABELS = [
        'building' => 'Pencarian Gedung (AR)',
        'quiz' => 'Kuis',
        'book' => 'Pencarian Buku (AR, lama)',
    ];

    public function getTargetImageUrlAttribute(): ?string
    {
        return $this->target_image_path ? asset($this->target_image_path) : null;
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        $path = $this->cover_image_path ?: $this->target_image_path;
        return $path ? asset($path) : null;
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPE_LABELS[$this->type] ?? ucfirst((string) $this->type);
    }

    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class, 'badge_reward_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_missions');
    }
}
