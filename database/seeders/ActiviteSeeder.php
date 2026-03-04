<?php

namespace Database\Seeders;

use App\Models\Activite;
use Illuminate\Database\Seeder;

class ActiviteSeeder extends Seeder
{
    public function run(): void
    {
        Activite::truncate();

        $activites = [
            [
                'titre'       => 'Hackathon',
                'description' => 'Participez à un hackathon intensif pour relever les défis numériques du Sahel à travers l\'innovation technologique.',
                'image'       => 'hackathon.png',
                'ordre'       => 1,
            ],
            [
                'titre'       => 'Concours de Programmation',
                'description' => 'Montrez vos compétences et remportez des prix pour vos solutions ingénieuses lors du concours du Meilleur Programmeur.',
                'image'       => 'digital-project-contest.png',
                'ordre'       => 2,
            ],
            [
                'titre'       => 'Meilleur Projet Digital',
                'description' => 'Présentez vos idées innovantes et propulsez votre startup ou projet lors de ce concours phare.',
                'image'       => 'digital-project-contest.png',
                'ordre'       => 3,
            ],
            [
                'titre'       => 'Conférences & Débats',
                'description' => 'Assistez à des conférences animées par des experts du numérique, avec un focus sur l\'IA et le développement de l\'économie numérique.',
                'image'       => 'startup-expo.png',
                'ordre'       => 4,
            ],
            [
                'titre'       => 'Exposition des Startups',
                'description' => 'Découvrez les startups les plus prometteuses du Sahel et leurs solutions technologiques innovantes.',
                'image'       => 'startup-expo.png',
                'ordre'       => 5,
            ],
        ];

        foreach ($activites as $a) {
            Activite::create(array_merge($a, ['actif' => true]));
        }
    }
}
