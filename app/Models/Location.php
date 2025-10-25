<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * Attribut yang bisa diisi secara massal (mass assignable).
     */
    protected $fillable = [
        'name',
        'description',
        'marker_id',
    ];
}
