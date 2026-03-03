<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programmeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'telephone',
        'email',
        'niveau_etude',
        'classe',
        'etablissement',
        'type_concours',
        'langages',
        'status',
    ];

    protected $casts = [
        'langages' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
