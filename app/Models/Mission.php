<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mission extends Model
{
    use HasFactory;

    /**
     * Attribut yang bisa diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'title',
        'description',
        'points_reward',
        'badge_reward_id',
    ];

    /**
     * Relasi ke Lencana (Badge) yang menjadi hadiah.
     */
    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class, 'badge_reward_id');
    }

    /**
     * Relasi ke User yang telah menyelesaikan misi ini.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_missions');
    }
}