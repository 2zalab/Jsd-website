<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscriptionConcours;
use App\Models\Concours;
use App\Models\Stand;
use App\Models\Hackathon;
use App\Models\Programmeur;
use App\Models\ProjetDigital;

class ConcoursController extends Controller
{

    public function index(){
        return view('concours.index');
    }

     // Concours de meilleur programmeur
     public function createProgrammeur()
     {
         $typesConcours = [
             'CMPL' => 'Concours Meilleur.e Programmeur.e Lycéen (CMPL)',
             'CMPS' => 'Concours Meilleur.e Programmeur.e Senior (CMPS)',
         ];
         $langagesProgrammation = [
             'JavaScript', 'Python', 'Java', 'C', 'C++', 'C#', 'Ruby', 'PHP', 'Swift',
             'Go', 'Rust', 'TypeScript', 'Kotlin', 'Scala', 'R', 'Dart',
             'Lua', 'Perl', 'Haskell', 'Julia', 'COBOL','Pascal'
         ];
         return view('concours.programmeur', compact('typesConcours', 'langagesProgrammation'));
     }

     public function storeProgrammeur(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'email' => 'required|email|unique:programmeurs,email', // Modifié pour référencer la bonne table
        'niveau_etude' => 'required|in:secondaire,superieur',
        'classe' => 'required|string|max:255',
        'etablissement' => 'required|string|max:255',
        'type_concours' => 'required|in:CMPL,CMPS',
        'langages' => 'required|array|min:1',
        'langages.*' => 'required|string',
    ]);

    // Création du programmeur avec les données validées
    Programmeur::create([
        'nom' => $validated['nom'], // Ajout de nom
        'telephone' => $validated['telephone'], // Ajout de téléphone
        'email' => $validated['email'], // Ajout de l'email
        'niveau_etude' => $validated['niveau_etude'], // Ajout du niveau d'étude
        'classe' => $validated['classe'], // Ajout de la classe
        'etablissement' => $validated['etablissement'],
        'type_concours' => $validated['type_concours'], // Ajout du type de concours
        'langages' => json_encode($validated['langages']), // Encodage en JSON si nécessaire
    ]);

    // Redirection avec un message de succès
    return redirect()->route('concours.programmeur')->with('success', 'Votre inscription au concours de programmeur a été enregistrée avec succès.');
}


     // Concours de meilleur projet digital
     public function createProjetDigital()
     {
         $typesConcours = [
             'CMPDL' => 'Concours de Meilleur Projet Digital Lycéen (CMPDL)',
             'CMPDS' => 'Concours de Meilleur Projet Digital Senior (CMPDS)',
         ];
         return view('concours.projet-digital', compact('typesConcours'));
     }

     public function storeProjetDigital(Request $request)
     {
         $validated = $request->validate([
            'nom_equipe' => 'required|string|max:255',
            'chef_equipe' => 'required|string|max:255',
            'email_chef_equipe' => 'required|email|max:255',
            'etablissement' => 'required|string|max:255',
            'niveau_etude' => 'required|in:secondaire,superieur',
            'classe' => 'required|string|max:255',
            'nom_projet' => 'required|string|max:255',
            'description_projet' => 'required|string',
            'livre_projet' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
            'certificat_scolarite' => 'nullable|file|mimes:pdf|max:5120', // 5MB max
            'lien_youtube' => 'nullable|url|max:255',
            'business_plan' => 'nullable|file|mimes:pdf|max:10240', // 10MB max
            'type_concours' => 'required|in:CMPDL,CMPDS',
         ]);

          // Additional validation to ensure type_concours matches niveau_etude
            if (($request->niveau_etude === 'secondaire' && $request->type_concours !== 'CMPDL') ||
            ($request->niveau_etude === 'superieur' && $request->type_concours !== 'CMPDS')) {
            return redirect()->back()->withErrors(['type_concours' => 'Le type de concours ne correspond pas au niveau d\'études sélectionné.'])->withInput();
        }

         // Traitement des fichiers uploadés
        $projetDigital = new ProjetDigital();
        $projetDigital->nom_equipe = $request->nom_equipe;
        $projetDigital->chef_equipe = $request->chef_equipe;
        $projetDigital->email_chef_equipe = $request->email_chef_equipe;
        $projetDigital->etablissement = $request->etablissement;
        $projetDigital->niveau_etude = $request->niveau_etude;
        $projetDigital->classe = $request->classe;
        $projetDigital->nom_projet = $request->nom_projet;
        $projetDigital->description_projet = $request->description_projet;
        $projetDigital->lien_youtube = $request->lien_youtube;
        $projetDigital->type_concours = $request->type_concours;

        // Traitement des fichiers
        if ($request->hasFile('livre_projet')) {
            $path = $request->file('livre_projet')->store('livres_projets', 'public');
            $projetDigital->livre_projet = $path;
        }

        if ($request->hasFile('certificat_scolarite')) {
            $path = $request->file('certificat_scolarite')->store('certificats_scolarite', 'public');
            $projetDigital->certificat_scolarite = $path;
        }

        if ($request->hasFile('business_plan')) {
            $path = $request->file('business_plan')->store('business_plans', 'public');
            $projetDigital->business_plan = $path;
        }

        $projetDigital->save();

         return redirect()->route('concours.projet-digital')->with('success', 'Votre projet digital a été soumis avec succès.');
     }

     // Hackathon
     public function createHackathon()
     {
         return view('concours.hackathon');
     }

     public function storeHackathon(Request $request)
     {
         $validated = $request->validate([
             'nom_equipe' => 'required|string|max:255',
             'nombre_participants' => 'required|integer|min:2|max:5',
             'nom_chef_equipe' => 'required|string|max:255',
             'telephone_chef_equipe' => 'required|string|max:20',
             'email_chef_equipe' => 'required|email|max:255',
             'etablissement' => 'required|string|max:255',
             'niveau_etudes' => 'required|string|max:255',
             'classe' => 'required|string|max:255',
             'membres' => 'required|array|min:1|max:4',
             'membres.*' => 'required|string|max:255',
         ]);

         // Assurez-vous que le nombre de membres correspond au nombre de participants moins le chef d'équipe
         if (count($validated['membres']) !== $validated['nombre_participants'] - 1) {
             return back()->withErrors(['membres' => 'Le nombre de membres doit correspondre au nombre de participants moins le chef d\'équipe.']);
         }


         $hackathon = Hackathon::create([
             'nom_equipe' => $validated['nom_equipe'],
             'nombre_participants' => $validated['nombre_participants'],
             'nom_chef_equipe' => $validated['nom_chef_equipe'],
             'telephone_chef_equipe' => $validated['telephone_chef_equipe'],
             'email_chef_equipe' => $validated['email_chef_equipe'],
             'etablissement' => $validated['etablissement'],
             'niveau_etudes' => $validated['niveau_etudes'],
             'classe' => $validated['classe'],
             'membres' => $validated['membres'],
         ]);

         return redirect()->route('concours.hackathon')->with('success', 'Votre équipe a été inscrite au Hackathon avec succès.');
     }

     // Réservation de stand
     public function createStand()
     {
         return view('concours.stand');
     }

     public function storeStand(Request $request)
     {
         $validated = $request->validate([
             'nom_entreprise' => 'required|string|max:255',
             'secteur_activite' => 'required|string|max:255',
             'adresse' => 'required|string',
             'email_contact' => 'required|email',
             'telephone_contact' => 'required|string',
             'taille_stand' => 'required|in:petit,moyen,grand',
             'besoins_specifiques' => 'nullable|string',
         ]);

         Stand::create($validated);

        // return redirect()->back()->with('success', 'Votre demande de parrainage a été soumise avec succès. Vous recevrez bientôt un email de confirmation !');
         return redirect()->route('concours.stand')->with('success', 'Votre réservation de stand a été enregistrée avec succès.');
     }

    public function showForm()
    {
        $typesConcours = [
            'hackathon' => 'Hackathon',
            'CMPL' => 'Concours Meilleur.e Programmeur.e Lycéen (CMPL),',
            'CMPDL' => 'Concours de Meilleur Projet Digital Senior(CMPDL)',
            'CMPS' => 'Concours Meilleur.e Programmeur.e Senior (CMPS)',
            'CMPDS' => 'Concours de Meilleur Projet Digital Senior(CMPDS)'
        ];
        return view('concours.inscription', compact('typesConcours'));
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:inscription_concours,email',
            'telephone' => 'required|string|max:20',
            'type_concours' => 'required|in:hackathon,CMPL,CMPS,CMPDL,CMPDS',
            'motivation' => 'required|string|min:10|max:500',
        ]);

        InscriptionConcours::create($request->all());

        return redirect()->back()->with('success', 'Votre inscription au concours a été enregistrée avec succès !');
    }
}
