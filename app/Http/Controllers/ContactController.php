<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Enregistrer les données dans la table contacts
    $contact = Contact::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'message' => $validated['message'],
    ]);

        // Logique pour traiter le formulaire (ex: envoyer un email)

        return redirect()->route('contact.index')->with('success', 'Message envoyé avec succès!');
    }
}
