<?php

namespace Database\Seeders;

use App\Models\Ressource;
use Illuminate\Database\Seeder;

class RessourceSeeder extends Seeder
{
    public function run(): void
    {
        Ressource::truncate();

        // ── PHOTOS JSD'23 ────────────────────────────────────────────────────
        $photos = [
            ['titre' => 'CMP JSD\'23',                      'description' => 'Les équipes en pleine action lors du concours de meilleur programmeur.',                         'fichier' => 'hack.jpg'],
            ['titre' => 'Panel sur l\'innovation au Sahel', 'description' => 'Experts et entrepreneurs partagent leurs visions pour l\'avenir.',                               'fichier' => 'conferences.png'],
            ['titre' => 'Présence du lycée de Godola',      'description' => 'Les élèves marquant leur présence aux Journées du Savoir Digital 2023.',                         'fichier' => 'eleves-godola.jpg'],
            ['titre' => 'Présentation des projets',         'description' => 'Concours des meilleurs projets digitaux lors de JSD\'23.',                                       'fichier' => 'projet-presentation.jpg'],
            ['titre' => 'Secrétariat technique',            'description' => 'Impression des badges pour les participants au JSD\'23.',                                         'fichier' => 'secretariat.jpg'],
            ['titre' => 'Photo de famille',                 'description' => 'Photo de groupe à la fin des Journées du Savoir Digital 2023.',                                  'fichier' => 'photo-famille.jpg'],
            ['titre' => 'Stands des partenaires',           'description' => 'Les entreprises partenaires présentent leurs solutions au JSD\'23.',                             'fichier' => 'roll-up.jpg'],
            ['titre' => 'Exposition dans les stands',       'description' => 'Présentation des innovations dans les stands des JSD\'23.',                                      'fichier' => 'startup-expo.png'],
            ['titre' => 'Candidats — Projets Digitaux',     'description' => 'Les participants au concours des meilleurs projets digitaux du JSD\'23.',                        'fichier' => 'candidats-cmpd.jpg'],
            ['titre' => 'Réunion de préparation',           'description' => 'Les équipes organisatrices en pleine réunion technique pour JSD\'23.',                           'fichier' => 'meet.jpg'],
            ['titre' => 'Community Manager',                'description' => 'Le CM gérant les communications digitales durant les JSD\'23.',                                   'fichier' => 'touza.jpg'],
            ['titre' => 'M. Douwé & M. Terdam',            'description' => 'Acteurs clés dans la planification des Journées du Savoir Digital 2023.',                        'fichier' => 'photo1.jpg'],
        ];

        foreach ($photos as $i => $p) {
            Ressource::create([
                'titre'       => $p['titre'],
                'description' => $p['description'],
                'type'        => 'photo',
                'fichier'     => $p['fichier'],
                'lien'        => null,
                'edition'     => 'JSD23',
                'categorie'   => null,
                'ordre'       => $i + 1,
            ]);
        }

        // ── DOCUMENTS JSD'23 ─────────────────────────────────────────────────
        $documents = [
            ['titre' => 'Programme officiel JSD\'23',         'description' => 'Programme complet de l\'édition 2023.',                  'categorie' => 'PDF'],
            ['titre' => 'Règlement des concours',             'description' => 'Conditions de participation aux concours JSD\'23.',       'categorie' => 'PDF'],
            ['titre' => 'Présentations des conférenciers',    'description' => 'Diapositives des interventions lors de JSD\'23.',         'categorie' => 'PPT'],
            ['titre' => 'Rapport de synthèse JSD\'23',        'description' => 'Bilan complet de la première édition 2023.',              'categorie' => 'PDF'],
            ['titre' => 'Pack photos haute résolution',       'description' => 'Toutes les photos de l\'événement JSD\'23.',             'categorie' => 'ZIP'],
            ['titre' => 'Palmarès des concours JSD\'23',      'description' => 'Résultats officiels et lauréats des concours.',           'categorie' => 'PDF'],
        ];

        foreach ($documents as $i => $d) {
            Ressource::create([
                'titre'       => $d['titre'],
                'description' => $d['description'],
                'type'        => 'document',
                'fichier'     => null,
                'lien'        => null,
                'edition'     => 'JSD23',
                'categorie'   => $d['categorie'],
                'ordre'       => $i + 1,
            ]);
        }
    }
}
