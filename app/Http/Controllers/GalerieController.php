<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use App\Models\Photo;
use Illuminate\Http\Request;

class GalerieController extends Controller
{
    public function index(Request $request)
    {
      
    $galeries = Galerie::all();

    $groupedGaleries = [];


    foreach ($galeries as $galerie) {
        $annee = date('Y', strtotime($galerie->date_galerie));
        $mois = date('n', strtotime($galerie->date_galerie));
        $key = $annee . '-' . $mois;

    
        if (!isset($groupedGaleries[$key])) {
            $groupedGaleries[$key] = [];
        }

        $groupedGaleries[$key][] = $galerie;
    }

        
   
    $photo = Photo::all();
    

    krsort($groupedGaleries);

    return view('galerie.index', compact('groupedGaleries', 'photo'));
    }    
 
}
