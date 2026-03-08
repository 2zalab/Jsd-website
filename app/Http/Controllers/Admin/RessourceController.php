<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ressource;
use App\Models\Edition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

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
        $editions   = Edition::orderByDesc('numero')->get();

        return view('admin.ressources.index', compact('ressources', 'editions', 'edition', 'type'));
    }

    public function create()
    {
        $editions = Edition::orderByDesc('numero')->get();
        return view('admin.ressources.form', ['ressource' => null, 'editions' => $editions]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:photo,document',
            'fichier'     => 'nullable|file|max:10240',
            'lien'        => 'nullable|url|max:500',
            'edition'     => ['required', Rule::in(Edition::pluck('nom'))],
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
        $editions = Edition::orderByDesc('numero')->get();
        return view('admin.ressources.form', compact('ressource', 'editions'));
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
            'edition'     => ['required', Rule::in(Edition::pluck('nom'))],
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

    public function exportPdf(Request $request)
    {
        $edition = $request->get('edition', 'all');
        $type    = $request->get('type', 'all');
        $query   = Ressource::query()->orderBy('edition')->orderBy('ordre');
        if ($edition !== 'all') $query->where('edition', $edition);
        if ($type    !== 'all') $query->where('type', $type);
        $ressources = $query->get();
        $pdf = Pdf::loadView('admin.exports.ressources-pdf', compact('ressources'))
                  ->setPaper('a4', 'landscape');
        return $pdf->download('ressources-jsd.pdf');
    }

    public function exportCsv(Request $request)
    {
        $edition = $request->get('edition', 'all');
        $type    = $request->get('type', 'all');
        $query   = Ressource::query()->orderBy('edition')->orderBy('ordre');
        if ($edition !== 'all') $query->where('edition', $edition);
        if ($type    !== 'all') $query->where('type', $type);
        $ressources = $query->get();

        $headers = ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename="ressources-jsd.csv"'];
        $callback = function () use ($ressources) {
            $fh = fopen('php://output', 'w');
            fprintf($fh, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($fh, ['ID', 'Titre', 'Description', 'Type', 'Édition', 'Catégorie', 'Fichier', 'Lien', 'Ordre'], ';');
            foreach ($ressources as $r) {
                fputcsv($fh, [$r->id, $r->titre, $r->description ?? '', $r->type, $r->edition, $r->categorie ?? '', $r->fichier ?? '', $r->lien ?? '', $r->ordre], ';');
            }
            fclose($fh);
        };
        return response()->stream($callback, 200, $headers);
    }
}
