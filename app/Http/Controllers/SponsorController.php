<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;
use Illuminate\Support\Facades\Validator;

class SponsorController extends Controller
{
    public function showForm()
    {
        return view('sponsor.form');
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'adresse' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'required|email',
            'motivation' => 'required|string|min:10',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
           // return response()->json(['errors' => $validator->errors()], 422);
        }

        $logoPath = $request->file('logo')->store('logos', 'public');

        Sponsor::create([
            'nom' => $request->nom,
            'logo' => $logoPath,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'motivation' => $request->motivation,
        ]);

        return redirect()->back()->with('success', 'Votre demande de parrainage a été soumise avec succès. Vous recevrez bientôt un email de confirmation !');
       //return response()->json(['message' => 'Votre demande de parrainage a été soumise avec succès. Vous recevrez bientôt un email de confirmation.']);
    }
}
