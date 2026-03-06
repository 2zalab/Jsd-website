<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create([
            'email' => $request->email,
        ]);

        try {
            Mail::to($request->email)->send(new NotificationMail(
                'Bienvenue dans la newsletter JSD !',
                'Vous êtes maintenant abonné(e) à la newsletter des Journées Sahel Digital. Vous recevrez en exclusivité les dernières actualités, annonces et informations sur nos événements.',
                'success',
                'Abonné(e)',
            ));
        } catch (\Exception) {}

        return response()->json(['message' => 'Inscription réussie à la newsletter !']);
    }
}
