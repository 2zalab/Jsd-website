<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::orderBy('ordre')->get();
        return view('admin.partenaires.index', compact('partenaires'));
    }

    public function create()
    {
        return view('admin.partenaires.form', ['partenaire' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'   => 'nullable|string|max:255',
            'logo'  => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'lien'  => 'nullable|url|max:255',
            'ordre' => 'nullable|integer|min:0',
            'actif' => 'boolean',
        ]);

        $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
        Storage::disk('public')->putFileAs('images', $request->file('logo'), $filename);

        Partenaire::create([
            'nom'   => $data['nom'] ?? null,
            'logo'  => $filename,
            'lien'  => $data['lien'] ?? null,
            'ordre' => $data['ordre'] ?? 0,
            'actif' => $request->boolean('actif', true),
        ]);

        return response()->json(['success' => true, 'message' => 'Partenaire ajouté avec succès.']);
    }

    public function edit($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        return view('admin.partenaires.form', compact('partenaire'));
    }

    public function update(Request $request, $id)
    {
        $partenaire = Partenaire::findOrFail($id);

        $data = $request->validate([
            'nom'   => 'nullable|string|max:255',
            'logo'  => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'lien'  => 'nullable|url|max:255',
            'ordre' => 'nullable|integer|min:0',
            'actif' => 'boolean',
        ]);

        $updateData = [
            'nom'   => $data['nom'] ?? null,
            'lien'  => $data['lien'] ?? null,
            'ordre' => $data['ordre'] ?? 0,
            'actif' => $request->boolean('actif', true),
        ];

        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo s'il a été uploadé (timestamp en préfixe)
            if ($partenaire->logo && Storage::disk('public')->exists('images/' . $partenaire->logo)) {
                Storage::disk('public')->delete('images/' . $partenaire->logo);
            }
            $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
            Storage::disk('public')->putFileAs('images', $request->file('logo'), $filename);
            $updateData['logo'] = $filename;
        }

        $partenaire->update($updateData);

        return response()->json(['success' => true, 'message' => 'Partenaire mis à jour avec succès.']);
    }

    public function destroy($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $partenaire->delete();
        return response()->json(['success' => true]);
    }

    public function toggleActif($id)
    {
        $partenaire = Partenaire::findOrFail($id);
        $partenaire->update(['actif' => !$partenaire->actif]);
        return response()->json(['success' => true, 'actif' => $partenaire->actif]);
    }
}
