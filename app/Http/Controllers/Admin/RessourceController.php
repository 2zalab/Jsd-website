<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    public function index(Request $request)
    {
        $edition = $request->get('edition', 'all');
        $type    = $request->get('type', 'all');

        $query = Ressource::query()->orderBy('edition')->orderBy('ordre');

        if ($edition !== 'all') $query->where('edition', $edition);
        if ($type !== 'all')    $query->where('type', $type);

        $ressources = $query->get();

        return view('admin.ressources.index', compact('ressources', 'edition', 'type'));
    }

    public function create()
    {
        return view('admin.ressources.form', ['ressource' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:photo,document',
            'fichier'     => 'nullable|file|max:10240',
            'lien'        => 'nullable|url|max:500',
            'edition'     => 'required|in:JSD23,JSD26',
            'categorie'   => 'nullable|string|max:50',
            'ordre'       => 'nullable|integer|min:0',
        ]);

        $filename = null;
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $filename = time() . '_' . $file->getClientOriginalName();
            $dest = $data['type'] === 'photo' ? 'images' : 'documents';
            $file->move(public_path($dest), $filename);
        }

        Ressource::create([
            'titre'       => $data['titre'],
            'description' => $data['description'] ?? null,
            'type'        => $data['type'],
            'fichier'     => $filename,
            'lien'        => $data['lien'] ?? null,
            'edition'     => $data['edition'],
            'categorie'   => $data['categorie'] ?? null,
            'ordre'       => $data['ordre'] ?? 0,
        ]);

        return response()->json(['success' => true, 'message' => 'Ressource ajoutée avec succès.']);
    }

    public function edit($id)
    {
        $ressource = Ressource::findOrFail($id);
        return view('admin.ressources.form', compact('ressource'));
    }

    public function update(Request $request, $id)
    {
        $ressource = Ressource::findOrFail($id);

        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:photo,document',
            'fichier'     => 'nullable|file|max:10240',
            'lien'        => 'nullable|url|max:500',
            'edition'     => 'required|in:JSD23,JSD26',
            'categorie'   => 'nullable|string|max:50',
            'ordre'       => 'nullable|integer|min:0',
        ]);

        $updateData = [
            'titre'       => $data['titre'],
            'description' => $data['description'] ?? null,
            'type'        => $data['type'],
            'lien'        => $data['lien'] ?? null,
            'edition'     => $data['edition'],
            'categorie'   => $data['categorie'] ?? null,
            'ordre'       => $data['ordre'] ?? 0,
        ];

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $filename = time() . '_' . $file->getClientOriginalName();
            $dest = $data['type'] === 'photo' ? 'images' : 'documents';
            $file->move(public_path($dest), $filename);
            $updateData['fichier'] = $filename;
        }

        $ressource->update($updateData);

        return response()->json(['success' => true, 'message' => 'Ressource mise à jour avec succès.']);
    }

    public function destroy($id)
    {
        Ressource::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
