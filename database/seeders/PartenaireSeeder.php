<?php

namespace Database\Seeders;

use App\Models\Partenaire;
use Illuminate\Database\Seeder;

class PartenaireSeeder extends Seeder
{
    public function run(): void
    {
        Partenaire::truncate();

        $partenaires = [
            ['nom' => 'Partenaire Officiel 1',                   'logo' => 'partner1.png',  'lien' => null, 'ordre' => 1],
            ['nom' => 'Partenaire Officiel 2',                   'logo' => 'partner2.jpeg', 'lien' => null, 'ordre' => 2],
            ['nom' => 'Partenaire Officiel 3',                   'logo' => 'partner3.png',  'lien' => null, 'ordre' => 3],
            ['nom' => 'Partenaire Officiel 4',                   'logo' => 'partner4.png',  'lien' => null, 'ordre' => 4],
            ['nom' => 'Partenaire Officiel 5',                   'logo' => 'partner5.png',  'lien' => null, 'ordre' => 5],
            ['nom' => 'Partenaire Officiel 6',                   'logo' => 'partner6.png',  'lien' => null, 'ordre' => 6],
            ['nom' => 'Partenaire Officiel 7',                   'logo' => 'partner7.png',  'lien' => null, 'ordre' => 7],
            ['nom' => 'Partenaire Officiel 8',                   'logo' => 'partner8.png',  'lien' => null, 'ordre' => 8],
            ['nom' => 'Partenaire Officiel 9',                   'logo' => 'partner9.jpeg', 'lien' => null, 'ordre' => 9],
            ['nom' => '2zaLab',                                  'logo' => 'partner10.png', 'lien' => 'https://2zalab.com', 'ordre' => 10],
            ['nom' => 'Massachusetts Institute of Technology',   'logo' => 'mit-logo.png',  'lien' => 'https://mit.edu',    'ordre' => 11],
        ];

        foreach ($partenaires as $p) {
            Partenaire::create(array_merge($p, ['actif' => true]));
        }
    }
}
