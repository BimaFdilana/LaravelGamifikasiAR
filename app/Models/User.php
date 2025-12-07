<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'total_points',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function calculateLevel($points)
    {
        if ($points >= 1000) return 5;
        if ($points >= 500) return 4;
        if ($points >= 250) return 3;
        if ($points >= 100) return 2;
        return 1;
    }

    public function badgesEarned(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'user_badges', 'user_id', 'badge_id');
    }

    public function missionsCompleted(): BelongsToMany
    {
        return $this->belongsToMany(Mission::class, 'user_missions', 'user_id', 'mission_id')
            ->withPivot('status', 'completed_at');
    }

    public function missions()
    {
        return $this->belongsToMany(Mission::class, 'user_missions', 'user_id', 'mission_id')
            ->withPivot('status', 'completed_at', 'order')
            ->withTimestamps()
            ->orderByPivot('order', 'asc');
    }
}