<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concours extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_concours',
        'nom',
        'prenom',
        'email',
        'niveau_etudes',
        'classe_secondaire',
        'annee_superieur',
    ];

    /*
    public function programmeur()
    {
        return $this->hasOne(Programmeur::class);
    }

    public function projetDigital()
    {
        return $this->hasOne(ProjetDigital::class);
    }

    public function hackathon()
    {
        return $this->hasOne(Hackathon::class);
    }

    */
}
