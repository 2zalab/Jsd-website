<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjetDigital extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_equipe',
        'chef_equipe',
        'email_chef_equipe',
        'etablissement',
        'niveau_etude',
        'classe',
        'nom_projet',
        'description_projet',
        'livre_projet',
        'certificat_scolarite',
        'lien_youtube',
        'business_plan',
        'type_concours', // CMPDL ou CMPDS
    ];


    /*
    public function concours()
    {
        return $this->belongsTo(Concours::class);
    }
    */
}
