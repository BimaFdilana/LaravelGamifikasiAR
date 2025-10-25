<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Badge extends Model
{
    use HasFactory;

    /**
     * Attribut yang bisa diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'name',
        'icon_url',
    ];

    /**
     * Relasi ke Misi yang memberikan lencana ini sebagai hadiah.
     */
    public function missions(): HasMany
    {
        return $this->hasMany(Mission::class, 'badge_reward_id');
    }

    /**
     * Relasi ke User yang memiliki lencana ini.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_badges');
    }
}