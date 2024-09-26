<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InscriptionConcours;

class InscriptionConcoursController extends Controller
{
    public function showForm()
    {
        $typesConcours = [
            'hackathon' => 'Hackathon',
            'programmation' => 'Concours de Programmation',
            'projet_digital' => 'Concours de Meilleur Projet Digital'
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
            'type_concours' => 'required|in:hackathon,programmation,projet_digital',
            'motivation' => 'required|string|min:10|max:500',
        ]);

        InscriptionConcours::create($request->all());

        return redirect()->back()->with('success', 'Votre inscription au concours a été enregistrée avec succès !');
    }
}
