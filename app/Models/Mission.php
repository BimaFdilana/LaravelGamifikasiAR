<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'target_image_name',
        'quiz_data',
        'points_reward',
        'badge_reward_id',
    ];

    protected $casts = [
        'quiz_data' => 'array',
    ];

    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class, 'badge_reward_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_missions');
    }
}
