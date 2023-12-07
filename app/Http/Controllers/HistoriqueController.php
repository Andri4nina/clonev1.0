<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use Illuminate\Http\Request;

class HistoriqueController extends Controller
{    public function index(Request $request)
    {
      
    $historique = Historique::orderBy('id', 'desc')->get();

    return view('historique.index', compact('historique'));
    }    
}
