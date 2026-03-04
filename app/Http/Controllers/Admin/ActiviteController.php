<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activite;
use Illuminate\Http\Request;

class ActiviteController extends Controller
{
    public function index()
    {
        $activites = Activite::orderBy('ordre')->get();
        return view('admin.activites.index', compact('activites'));
    }

    public function create()
    {
        return view('admin.activites.form', ['activite' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'ordre'       => 'nullable|integer|min:0',
            'actif'       => 'boolean',
        ]);

        $imageFilename = null;
        if ($request->hasFile('image')) {
            $imageFilename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $imageFilename);
        }

        Activite::create([
            'titre'       => $data['titre'],
            'description' => $data['description'],
            'image'       => $imageFilename,
            'ordre'       => $data['ordre'] ?? 0,
            'actif'       => $request->boolean('actif', true),
        ]);

        return response()->json(['success' => true, 'message' => 'Activité ajoutée avec succès.']);
    }

    public function edit($id)
    {
        $activite = Activite::findOrFail($id);
        return view('admin.activites.form', compact('activite'));
    }

    public function update(Request $request, $id)
    {
        $activite = Activite::findOrFail($id);

        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'ordre'       => 'nullable|integer|min:0',
            'actif'       => 'boolean',
        ]);

        $updateData = [
            'titre'       => $data['titre'],
            'description' => $data['description'],
            'ordre'       => $data['ordre'] ?? 0,
            'actif'       => $request->boolean('actif', true),
        ];

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $filename);
            $updateData['image'] = $filename;
        }

        $activite->update($updateData);

        return response()->json(['success' => true, 'message' => 'Activité mise à jour avec succès.']);
    }

    public function destroy($id)
    {
        Activite::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
