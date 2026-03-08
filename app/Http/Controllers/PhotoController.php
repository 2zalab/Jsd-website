<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;
use App\Models\Edition;

class PhotoController extends Controller
{
    public function index()
    {
        $editions = Edition::orderByDesc('numero')->get();

        $ressourcesParEdition = $editions->map(function ($ed) {
            return [
                'edition' => $ed,
                'photos'  => Ressource::edition($ed->nom)->photos()->orderBy('ordre')->get(),
                'docs'    => Ressource::edition($ed->nom)->documents()->orderBy('ordre')->get(),
            ];
        });

        return view('ressources.index', compact('editions', 'ressourcesParEdition'));
    }
}
