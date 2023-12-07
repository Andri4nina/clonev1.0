<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use App\Models\Membre;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 10;
        if (!empty($keyword)) {
            $membre = Membre::select('membres.id','membres.nom_membre','membres.pdp_membre','membres.poste_membre','membres.descri_membre')
                ->where("membres.nom_membre", "LIKE", "%$keyword%")         
                ->orWhere("membres.poste_membre", "LIKE", "%$keyword%")
                ->orderBy('membres.id', 'desc')
                ->paginate($perPage);

        } else {
            $membre = Membre::select('membres.id','membres.nom_membre','membres.pdp_membre','membres.poste_membre','membres.descri_membre')
           ->paginate($perPage);
        }
       
        return view('membre.index', compact('membre'))
        ->with('i', ($request->input('page', 1) - 1) * $perPage);
    }


    public function create()
    {
        return view('membre.create');
    }

    public function edit($id)
    {
        $membre = Membre::findOrfail($id);
        return view ('membre.edit',['membre' => $membre]);
    }


    public function store(Request $request)
    {
       $request->validate([
            'membre-nom' => 'required',
            'membre-pdp' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $membre = new Membre();
    
        if ($request->hasFile('membre-pdp') && $request->file('membre-pdp')->isValid()) {
            $file_name = time() . '.' . $request->file('membre-pdp')->getClientOriginalExtension();
            $request->file('membre-pdp')->move(public_path('images/pdp-membre'), $file_name);
            $membre->pdp_membre = $file_name;
        }
    
        $membre->nom_membre = $request->input('membre-nom');
        $membre->descri_membre = $request->input('membre-description');
        $membre->poste_membre = $request->input('membre-poste');
        $membre->date_adhesion_membre = $request->input('membre-adhesion');
       
        $historique = $request->input('the_user') . " a ajouter le membre '" . $membre->nom_membre . "'";
      
        $histo = new Historique();
       $histo->descri_histo = $historique;
       $histo->save();
        $membre->save();
    
        return redirect()->route('membre.index')->with('success', 'Membre créé avec succès ,Souhaiton sa bienvenue');
    }


    public function update(Request $request,Membre $membre)
    {

       $request->validate([
            'membre-nom' => 'required',
            'membre-pdp' => '|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
    
        if ($request->hasFile('membre-pdp') && $request->file('membre-pdp')->isValid()) {
            $file_name = time() . '.' . $request->file('membre-pdp')->getClientOriginalExtension();
            $request->file('membre-pdp')->move(public_path('images/pdp-membre'), $file_name);
    
        }
        else 
        {
            $file_name =$request->hidden_membre_pdp; 
        }
        $membre= Membre::find($request->hidden_id);
        $membre->pdp_membre = $file_name;
        $membre->nom_membre = $request->input('membre-nom');
        $membre->descri_membre = $request->input('membre-description');
        $membre->poste_membre = $request->input('membre-poste');
        $membre->date_adhesion_membre = $request->input('membre-adhesion');
       
        $historique = $request->input('the_user') . " a mis a jour le membre '" . $membre->nom_membre . "'";
      
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        $membre->save();
    
        $membre->save();
    
        return redirect()->route('membre.index')->with('success', 'Membre modifier avec succès');
    }

    public function destroy(Request $request, $id){
        $membre= Membre::findOrFail($id);
        $image_path = public_path()."/images/pdp/";  
        $image= $image_path. $membre->pdp;
        if(file_exists($image)){
            @unlink($image);
        }
        $historique = $request->input('the_user') . " a supprimer le membre '" . $membre->nom_membre . "'";
      
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        $membre->save();
    
        $membre->delete();
        return redirect('membre')->with('success','Membre supprimer!');
    }

    
}
