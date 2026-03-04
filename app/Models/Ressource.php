<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre', 'description', 'type', 'fichier', 'lien', 'edition', 'categorie', 'ordre',
    ];

    public function scopeEdition($query, string $edition)
    {
        return $query->where('edition', $edition)->orderBy('ordre');
    }

    public function scopePhotos($query)
    {
        return $query->where('type', 'photo');
    }

    public function scopeDocuments($query)
    {
        return $query->where('type', 'document');
    }
}
