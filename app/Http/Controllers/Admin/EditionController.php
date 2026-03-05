<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Edition;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    public function index()
    {
        $editions = Edition::orderByDesc('numero')->get();
        return view('admin.editions.index', compact('editions'));
    }

    public function show($id)
    {
        return response()->json(Edition::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'                     => 'required|string|max:50',
            'numero'                  => 'required|integer|min:1',
            'annee'                   => 'required|integer|min:2000|max:2100',
            'theme'                   => 'nullable|string',
            'date_debut'              => 'nullable|date',
            'date_fin'                => 'nullable|date|after_or_equal:date_debut',
            'date_limite_inscription' => 'nullable|date',
            'lieu'                    => 'nullable|string|max:255',
            'description'             => 'nullable|string',
            'mot_president'           => 'nullable|string',
            'stats_participants'      => 'nullable|integer|min:0',
            'stats_projets'           => 'nullable|integer|min:0',
            'stats_programmeurs'      => 'nullable|integer|min:0',
            'est_courante'            => 'nullable|boolean',
        ]);

        $data['est_courante'] = isset($data['est_courante']) && $data['est_courante'];

        if ($data['est_courante']) {
            Edition::query()->update(['est_courante' => false]);
        }

        Edition::create($data);

        return response()->json(['success' => true, 'message' => 'Édition créée avec succès.']);
    }

    public function update(Request $request, $id)
    {
        $edition = Edition::findOrFail($id);

        $data = $request->validate([
            'nom'                     => 'required|string|max:50',
            'numero'                  => 'required|integer|min:1',
            'annee'                   => 'required|integer|min:2000|max:2100',
            'theme'                   => 'nullable|string',
            'date_debut'              => 'nullable|date',
            'date_fin'                => 'nullable|date|after_or_equal:date_debut',
            'date_limite_inscription' => 'nullable|date',
            'lieu'                    => 'nullable|string|max:255',
            'description'             => 'nullable|string',
            'mot_president'           => 'nullable|string',
            'stats_participants'      => 'nullable|integer|min:0',
            'stats_projets'           => 'nullable|integer|min:0',
            'stats_programmeurs'      => 'nullable|integer|min:0',
            'est_courante'            => 'nullable|boolean',
        ]);

        $data['est_courante'] = isset($data['est_courante']) && $data['est_courante'];

        if ($data['est_courante']) {
            Edition::query()->where('id', '!=', $id)->update(['est_courante' => false]);
        }

        $edition->update($data);

        return response()->json(['success' => true, 'message' => 'Édition mise à jour.']);
    }

    public function destroy($id)
    {
        Edition::findOrFail($id)->delete();
        return response()->json(['success' => true, 'message' => 'Édition supprimée.']);
    }

    public function setCourante($id)
    {
        $edition = Edition::findOrFail($id);
        $edition->setCourante();
        return response()->json(['success' => true, 'message' => "'{$edition->nom}' est maintenant l'édition courante."]);
    }
}
