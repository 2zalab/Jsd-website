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
            $key = str_replace("'", "", $ed->nom); // JSD'23 → JSD23
            return [
                'edition' => $ed,
                'photos'  => Ressource::edition($key)->photos()->orderBy('ordre')->get(),
                'docs'    => Ressource::edition($key)->documents()->orderBy('ordre')->get(),
            ];
        });

        return view('ressources.index', compact('editions', 'ressourcesParEdition'));
    }
}
