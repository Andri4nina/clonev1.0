<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\publication;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function acceuil(Request $request){
        $keyword = $request->get('search');
        $perPagePubli = 3;
        if (!empty($keyword)) {
            $publication = publication::select('publications.*')
                ->where("titre_publi", "LIKE", "%$keyword%")
                ->orWhere("status_publi", "LIKE", "Publier")
                ->orderBy('publications.created_at', 'desc')
                ->paginate($perPagePubli);
        } else {
            $publication = Publication::select('publications.*')
                ->where("status_publi", "LIKE", "Publier")
                ->orderBy('publications.created_at', 'desc')
                ->paginate($perPagePubli);
        }
        $partenaire = Partenaire::select('*')
        ->where("status_part", "LIKE", "Publier")
        ->limit(3)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('visiteur.pages.acceuil', [
            'publication' => $publication,
            'partenaire' => $partenaire
        ])->with('i', ($request->input('page', 1) - 1) * 5);
    }
   }