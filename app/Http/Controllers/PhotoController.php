<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ressource;

class PhotoController extends Controller
{
    public function index()
    {
        $jsd23Photos = Ressource::edition('JSD23')->photos()->orderBy('ordre')->get();
        $jsd23Docs   = Ressource::edition('JSD23')->documents()->orderBy('ordre')->get();
        $jsd26Photos = Ressource::edition('JSD26')->photos()->orderBy('ordre')->get();
        $jsd26Docs   = Ressource::edition('JSD26')->documents()->orderBy('ordre')->get();

        return view('ressources.index', compact('jsd23Photos', 'jsd23Docs', 'jsd26Photos', 'jsd26Docs'));
    }
}
