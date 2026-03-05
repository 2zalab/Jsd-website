<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = [
        'nom', 'numero', 'annee', 'theme',
        'date_debut', 'date_fin', 'date_limite_inscription',
        'lieu', 'description', 'mot_president',
        'stats_participants', 'stats_projets', 'stats_programmeurs',
        'est_courante',
    ];

    protected $casts = [
        'date_debut'              => 'date',
        'date_fin'                => 'date',
        'date_limite_inscription' => 'date',
        'est_courante'            => 'boolean',
    ];

    /**
     * Retourne l'édition courante, ou null si aucune n'est définie.
     */
    public static function courante(): ?self
    {
        return static::where('est_courante', true)->first()
            ?? static::orderByDesc('numero')->first();
    }

    /**
     * Définit cette édition comme courante (et désactive les autres).
     */
    public function setCourante(): void
    {
        static::query()->update(['est_courante' => false]);
        $this->update(['est_courante' => true]);
    }
}
