<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantHackathon extends Model
{
    use HasFactory;

    protected $fillable = [
        'hackathon_id',
        'nom',
        'prenom',
        'email',
        'competences',
    ];

    public function hackathon()
    {
        return $this->belongsTo(Hackathon::class);
    }
}
