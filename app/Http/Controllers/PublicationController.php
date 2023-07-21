<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\publication;

class PublicationController extends Controller
{
    public function index()
    {
        $publication = publication::orderby('created_at')->get();
        return view('publication.index', ['publication' => $publication]);
    }



    public function create()
    {
        return view('publication.create');
    }

    public function store(Request $request)
    {
   
        $request->validate([
            'titre_publi'=>'required'
        ]);

        $publication = new publication;
        $publication->titre_publi = $request->titre_publi;
        $publication->sous_titre_publi = $request->sous_titre_publi;
        $publication->contenu_publi = $request->contenu_publi;
        $publication->titre_publi = $request->titre_publi;
        if ($request->hasFile('image')) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $publication->img_couv_publi = $file_name;
        };

        $publication->save();
        return redirect()->route('publication.index')->with('succes', 'Blog creer avec succes');
    }
}
