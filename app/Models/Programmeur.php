<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programmeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'niveau_etude',
        'classe',
        'etablissement',
        'type_concours',
        'langages'
    ];

    protected $casts = [
        'langages' => 'array',
    ];

}
