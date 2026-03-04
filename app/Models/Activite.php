<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'description', 'image', 'ordre', 'actif'];

    protected $casts = [
        'actif' => 'boolean',
    ];

    public function scopeActif($query)
    {
        return $query->where('actif', true)->orderBy('ordre');
    }
}
