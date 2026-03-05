<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Edition;

class EditionSeeder extends Seeder
{
    public function run(): void
    {
        Edition::truncate();

        $editions = [
            [
                'nom'                     => "JSD'23",
                'numero'                  => 1,
                'annee'                   => 2023,
                'theme'                   => "Entrepreneuriat numérique et promotion de l'écosystème digital dans le Sahel",
                'date_debut'              => '2023-11-23',
                'date_fin'                => '2023-11-25',
                'date_limite_inscription' => '2023-11-10',
                'lieu'                    => 'Maroua, Cameroun',
                'description'             => "La première édition des Journées Sahel Digital a rassemblé plus de 500 participants autour de l'entrepreneuriat numérique.",
                'stats_participants'      => 500,
                'stats_projets'           => 11,
                'stats_programmeurs'      => 22,
                'est_courante'            => false,
            ],
            [
                'nom'                     => "JSD'24",
                'numero'                  => 2,
                'annee'                   => 2024,
                'theme'                   => "Innovation numérique et développement durable dans le Sahel",
                'date_debut'              => '2024-11-26',
                'date_fin'                => '2024-11-28',
                'date_limite_inscription' => '2024-11-15',
                'lieu'                    => 'Maroua, Cameroun',
                'description'             => "La deuxième édition des Journées Sahel Digital a approfondi les thématiques d'innovation pour le développement durable.",
                'stats_participants'      => 0,
                'stats_projets'           => 0,
                'stats_programmeurs'      => 0,
                'est_courante'            => false,
            ],
            [
                'nom'                     => "JSD'26",
                'numero'                  => 3,
                'annee'                   => 2026,
                'theme'                   => "Intelligence artificielle et développement de l'économie numérique : enjeux et perspectives pour le Sahel",
                'date_debut'              => '2026-11-26',
                'date_fin'                => '2026-11-28',
                'date_limite_inscription' => '2026-11-15',
                'lieu'                    => 'Maroua, Cameroun',
                'description'             => "La troisième édition des Journées Sahel Digital place l'intelligence artificielle au cœur du développement numérique dans le Sahel.",
                'mot_president'           => "C'est avec une immense fierté que je vous souhaite une massive participation à la troisième édition des Journées Sahel Digital (JSD'26). Sous le thème « Intelligence artificielle et développement de l'économie numérique : enjeux et perspectives pour le Sahel », cet événement se veut un espace de réflexion, de création et d'action pour les jeunes talents et entrepreneur·e·s du Sahel.\n\nEn tant que promoteurs de cette initiative, nous croyons fermement que l'avenir du continent africain passe par l'innovation technologique et numérique. L'intelligence artificielle offre des opportunités inédites pour relever les défis socio-économiques auxquels nous sommes confrontés.\n\nQue vous soyez programmeur·euse, entrepreneur·euse, étudiant·e ou simplement passionné·e du numérique, les Journées Sahel Digital sont faites pour vous. Ensemble, cultivons l'esprit d'innovation pour un Sahel prospère, connecté et résilient.",
                'stats_participants'      => 0,
                'stats_projets'           => 0,
                'stats_programmeurs'      => 0,
                'est_courante'            => true,
            ],
        ];

        foreach ($editions as $data) {
            Edition::create($data);
        }
    }
}
