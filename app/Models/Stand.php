<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_entreprise',
        'secteur_activite',
        'adresse',
        'email_contact',
        'telephone_contact',
        'taille_stand',
        'besoins_specifiques',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
