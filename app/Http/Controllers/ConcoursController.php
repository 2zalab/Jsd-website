<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stand;
use App\Models\Hackathon;
use App\Models\Programmeur;
use App\Models\ProjetDigital;

class ConcoursController extends Controller
{
    public function __construct()
    {
        // Tout sauf la page d'accueil concours nécessite un compte
        // → Si non connecté, redirigé vers /login avec URL d'intention
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {
        return view('concours.index');
    }

    // ─── Concours Programmeur ────────────────────────────────────────────
    public function createProgrammeur()
    {
        $typesConcours = [
            'CMPL' => 'Concours Meilleur.e Programmeur.e Lycéen (CMPL)',
            'CMPS' => 'Concours Meilleur.e Programmeur.e Senior (CMPS)',
        ];
        $langagesProgrammation = [
            'JavaScript', 'Python', 'Java', 'C', 'C++', 'C#', 'Ruby', 'PHP', 'Swift',
            'Go', 'Rust', 'TypeScript', 'Kotlin', 'Scala', 'R', 'Dart',
            'Lua', 'Perl', 'Haskell', 'Julia', 'COBOL', 'Pascal',
        ];
        return view('concours.programmeur', compact('typesConcours', 'langagesProgrammation'));
    }

    public function storeProgrammeur(Request $request)
    {
        $validated = $request->validate([
            'nom'           => 'required|string|max:255',
            'telephone'     => 'required|string|max:255',
            'email'         => 'required|email|unique:programmeurs,email',
            'niveau_etude'  => 'required|in:secondaire,superieur',
            'classe'        => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'type_concours' => 'required|in:CMPL,CMPS',
            'langages'      => 'required|array|min:1',
            'langages.*'    => 'required|string',
        ]);

        Programmeur::create(array_merge($validated, [
            'user_id' => Auth::id(),
            'langages' => json_encode($validated['langages']),
        ]));

        $success = 'Votre inscription au concours de programmeur a été enregistrée avec succès.';
        if ($request->input('_from') === 'dashboard') {
            return redirect()->route('dashboard')->with('success', $success);
        }
        return redirect()->route('concours.programmeur')->with('success', $success);
    }

    // ─── Projet Digital ──────────────────────────────────────────────────
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
        $request->validate([
            'nom_equipe'           => 'required|string|max:255',
            'chef_equipe'          => 'required|string|max:255',
            'email_chef_equipe'    => 'required|email|max:255',
            'etablissement'        => 'required|string|max:255',
            'niveau_etude'         => 'required|in:secondaire,superieur',
            'classe'               => 'required|string|max:255',
            'nom_projet'           => 'required|string|max:255',
            'description_projet'   => 'required|string',
            'livre_projet'         => 'nullable|file|mimes:pdf|max:10240',
            'certificat_scolarite' => 'nullable|file|mimes:pdf|max:5120',
            'lien_youtube'         => 'nullable|url|max:255',
            'business_plan'        => 'nullable|file|mimes:pdf|max:10240',
            'type_concours'        => 'required|in:CMPDL,CMPDS',
        ]);

        if (($request->niveau_etude === 'secondaire' && $request->type_concours !== 'CMPDL') ||
            ($request->niveau_etude === 'superieur'  && $request->type_concours !== 'CMPDS')) {
            return back()->withErrors(['type_concours' => 'Le type de concours ne correspond pas au niveau d\'études.'])->withInput();
        }

        $projetDigital = new ProjetDigital();
        $projetDigital->user_id             = Auth::id();
        $projetDigital->nom_equipe          = $request->nom_equipe;
        $projetDigital->chef_equipe         = $request->chef_equipe;
        $projetDigital->email_chef_equipe   = $request->email_chef_equipe;
        $projetDigital->etablissement       = $request->etablissement;
        $projetDigital->niveau_etude        = $request->niveau_etude;
        $projetDigital->classe              = $request->classe;
        $projetDigital->nom_projet          = $request->nom_projet;
        $projetDigital->description_projet  = $request->description_projet;
        $projetDigital->lien_youtube        = $request->lien_youtube;
        $projetDigital->type_concours       = $request->type_concours;

        if ($request->hasFile('livre_projet')) {
            $projetDigital->livre_projet = $request->file('livre_projet')->store('livres_projets', 'public');
        }
        if ($request->hasFile('certificat_scolarite')) {
            $projetDigital->certificat_scolarite = $request->file('certificat_scolarite')->store('certificats_scolarite', 'public');
        }
        if ($request->hasFile('business_plan')) {
            $projetDigital->business_plan = $request->file('business_plan')->store('business_plans', 'public');
        }

        $projetDigital->save();

        $success = 'Votre projet digital a été soumis avec succès.';
        if ($request->input('_from') === 'dashboard') {
            return redirect()->route('dashboard')->with('success', $success);
        }
        return redirect()->route('concours.projet-digital')->with('success', $success);
    }

    // ─── Hackathon ───────────────────────────────────────────────────────
    public function createHackathon()
    {
        return view('concours.hackathon');
    }

    public function storeHackathon(Request $request)
    {
        $validated = $request->validate([
            'nom_equipe'             => 'required|string|max:255',
            'nombre_participants'    => 'required|integer|min:2|max:5',
            'nom_chef_equipe'        => 'required|string|max:255',
            'telephone_chef_equipe'  => 'required|string|max:20',
            'email_chef_equipe'      => 'required|email|max:255',
            'etablissement'          => 'required|string|max:255',
            'niveau_etudes'          => 'required|string|max:255',
            'classe'                 => 'required|string|max:255',
            'membres'                => 'required|array|min:1|max:4',
            'membres.*'              => 'required|string|max:255',
        ]);

        if (count($validated['membres']) !== $validated['nombre_participants'] - 1) {
            return back()->withErrors(['membres' => 'Le nombre de membres doit correspondre au nombre de participants moins le chef d\'équipe.']);
        }

        Hackathon::create(array_merge($validated, ['user_id' => Auth::id()]));

        $success = 'Votre équipe a été inscrite au Hackathon avec succès.';
        if ($request->input('_from') === 'dashboard') {
            return redirect()->route('dashboard')->with('success', $success);
        }
        return redirect()->route('concours.hackathon')->with('success', $success);
    }

    // ─── Stand ───────────────────────────────────────────────────────────
    public function createStand()
    {
        return view('concours.stand');
    }

    public function storeStand(Request $request)
    {
        $validated = $request->validate([
            'nom_entreprise'      => 'required|string|max:255',
            'secteur_activite'    => 'required|string|max:255',
            'adresse'             => 'required|string',
            'email_contact'       => 'required|email',
            'telephone_contact'   => 'required|string',
            'taille_stand'        => 'required|in:petit,moyen,grand',
            'besoins_specifiques' => 'nullable|string',
        ]);

        Stand::create(array_merge($validated, ['user_id' => Auth::id()]));

        $success = 'Votre réservation de stand a été enregistrée avec succès.';
        if ($request->input('_from') === 'dashboard') {
            return redirect()->route('dashboard')->with('success', $success);
        }
        return redirect()->route('concours.stand')->with('success', $success);
    }
}
