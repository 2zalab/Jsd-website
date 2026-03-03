<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_equipe',
        'nombre_participants',
        'nom_chef_equipe',
        'telephone_chef_equipe',
        'email_chef_equipe',
        'etablissement',
        'niveau_etudes',
        'classe',
        'membres',
        'status',
    ];

    protected $casts = [
        'membres' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setMembresAttribute($value)
    {
        $this->attributes['membres'] = json_encode($value);
    }

    public function getMembresAttribute($value)
    {
        return json_decode($value, true);
    }
}
