<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function programmeurs()
    {
        return $this->hasMany(Programmeur::class);
    }

    public function projetDigitals()
    {
        return $this->hasMany(ProjetDigital::class);
    }

    public function hackathons()
    {
        return $this->hasMany(Hackathon::class);
    }

    public function stands()
    {
        return $this->hasMany(Stand::class);
    }

    public function notifications()
    {
        return $this->hasMany(UserNotification::class)->latest();
    }

    public function unreadNotificationsCount(): int
    {
        return $this->notifications()->whereNull('read_at')->count();
    }

    /** Toutes les inscriptions de l'utilisateur, tous types confondus */
    public function allInscriptions(): array
    {
        $inscriptions = [];

        foreach ($this->programmeurs()->latest()->get() as $item) {
            $inscriptions[] = [
                'type'  => 'Concours Programmeur',
                'label' => $item->type_concours === 'CMPL' ? 'CMPL — Lycéen' : 'CMPS — Senior',
                'name'  => $item->nom,
                'date'  => $item->created_at,
                'status'=> $item->status,
                'id'    => $item->id,
                'model' => 'programmeur',
            ];
        }

        foreach ($this->projetDigitals()->latest()->get() as $item) {
            $inscriptions[] = [
                'type'  => 'Projet Digital',
                'label' => $item->type_concours === 'CMPDL' ? 'CMPDL — Lycéen' : 'CMPDS — Senior',
                'name'  => $item->nom_equipe . ' — ' . $item->nom_projet,
                'date'  => $item->created_at,
                'status'=> $item->status,
                'id'    => $item->id,
                'model' => 'projet_digital',
            ];
        }

        foreach ($this->hackathons()->latest()->get() as $item) {
            $inscriptions[] = [
                'type'  => 'Hackathon',
                'label' => 'Hackathon JSD\'24',
                'name'  => $item->nom_equipe,
                'date'  => $item->created_at,
                'status'=> $item->status,
                'id'    => $item->id,
                'model' => 'hackathon',
            ];
        }

        foreach ($this->stands()->latest()->get() as $item) {
            $inscriptions[] = [
                'type'  => 'Stand',
                'label' => ucfirst($item->taille_stand) . ' stand',
                'name'  => $item->nom_entreprise,
                'date'  => $item->created_at,
                'status'=> $item->status,
                'id'    => $item->id,
                'model' => 'stand',
            ];
        }

        usort($inscriptions, fn($a, $b) => $b['date'] <=> $a['date']);

        return $inscriptions;
    }
}
