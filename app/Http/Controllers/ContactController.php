<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotification;
use App\Mail\NotificationMail;

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

        Contact::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'message' => $validated['message'],
        ]);

        // Notify admin of new contact message
        try {
            Mail::to(config('mail.from.address'))->send(new ContactNotification(
                $validated['name'],
                $validated['email'],
                $validated['message'],
            ));
        } catch (\Exception) {}

        // Auto-reply to the sender
        try {
            Mail::to($validated['email'])->send(new NotificationMail(
                'Message bien reçu — Journées Sahel Digital',
                'Bonjour ' . $validated['name'] . ', nous avons bien reçu votre message et vous contacterons dans les meilleurs délais. Merci de l\'intérêt que vous portez aux Journées Sahel Digital !',
                'success',
                $validated['name'],
            ));
        } catch (\Exception) {}

        return redirect()->route('contact.index')->with('success', 'Message envoyé avec succès !');
    }
}

