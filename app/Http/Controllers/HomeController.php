<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Affiche la page des activités.
     *
     * @return \Illuminate\View\View
     */
    public function activities()
    {
        return view('activities');
    }

    /**
     * Affiche la page des photos.
     *
     * @return \Illuminate\View\View
     */
    public function photos()
    {
        return view('photos');
    }

    /**
     * Affiche la page "À propos".
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Affiche la page des contacts.
     *
     * @return \Illuminate\View\View
     */
    public function contacts()
    {
        return view('contacts');
    }

    /**
     * Traite la soumission du formulaire de newsletter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscriptions,email',
        ]);

        // Ici, vous pouvez ajouter la logique pour enregistrer l'email dans la base de données
        // ou l'envoyer à un service de newsletter

        return back()->with('success', 'Merci pour votre inscription à notre newsletter !');
    }

    /**
     * Traite la soumission du formulaire de contact.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Ici, vous pouvez ajouter la logique pour enregistrer le message de contact
        // ou l'envoyer par email à l'administrateur du site

        return back()->with('success', 'Merci pour votre message. Nous vous contacterons bientôt !');
    }
}
