<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartController extends Controller
{

    public function index(Request $request){
            $keyword = $request->get('search');
            $perPage = 10;
            if (!empty($keyword)) {
                $partenaire = Partenaire::select('partenaires.id','partenaires.nom_partenaire','partenaires.abbrev_partenaire','partenaires.histoire_partenaire','partenaires.siteOff_partenaire','partenaires.logo_partenaire','partenaires.status_partenaire','partenaires.date_relation_partenaire')
                    ->where("partenaires.nom_partenaire", "LIKE", "%$keyword%")         
                    ->orWhere("partenaires.abbrev_partenaire", "LIKE", "%$keyword%")
                    ->orderBy('partenaires.id', 'desc')
                    ->paginate($perPage);
    
            } else {
                $partenaire = Partenaire::select('partenaires.id','partenaires.nom_partenaire','partenaires.abbrev_partenaire','partenaires.histoire_partenaire','partenaires.siteOff_partenaire','partenaires.logo_partenaire','partenaires.status_partenaire','partenaires.date_relation_partenaire')
                ->paginate($perPage);
            }
           
            return view('partenaire.index', compact('partenaire'))
            ->with('i', ($request->input('page', 1) - 1) * $perPage);
    
    }


    public function create()
    {
        return view('partenaire.create');
    }

    public function edit($id)
    {
        $partenaire = Partenaire::findOrfail($id);
        return view ('partenaire.edit',['partenaire' => $partenaire]);
    }

    public function destroy($id){
        $partenaire= Partenaire::findOrFail($id);
        $image_path = public_path()."/images/pdp/";  
        $image= $image_path. $partenaire->logo_partenaire;
        if(file_exists($image)){
            @unlink($image);
        }
    
        $partenaire->delete();
        return redirect('partenaire')->with('success','Partenaire supprimer!');
    }


    public function show($id)
    {
        $partenaire = Partenaire::findOrfail($id);
        return view ('partenaire.show',['partenaire' => $partenaire]);
    }

    public function store(Request $request)
    {
       $request->validate([
            'partenaire-name' => 'required',
            'partenaire-logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $partenaire = new partenaire();
    
        if ($request->hasFile('partenaire-logo') && $request->file('partenaire-logo')->isValid()) {
            $file_name = time() . '.' . $request->file('partenaire-logo')->getClientOriginalExtension();
            $request->file('partenaire-logo')->move(public_path('images/pdp-partenaire'), $file_name);
            $partenaire->logo_partenaire = $file_name;
        }   
        else {
            $partenaire->logo_partenaire = 'images/sans-image/nopdp.png';
        }
    
        $partenaire->nom_partenaire = $request->input('partenaire-name');
        $partenaire->histoire_partenaire = $request->input('partenaire-histo');
        $partenaire->abbrev_partenaire = $request->input('partenaire-abr');
        $partenaire->siteOff_partenaire = $request->input('partenaire-url');
        $partenaire->date_relation_partenaire = $request->input('partenaire-date');
       
    
        $partenaire->save();
    
        return redirect()->route('partenaire.index')->with('success', 'partenaire créé avec succès ,Souhaiton sa bienvenue');
    }

    public function update(Request $request,partenaire $partenaire)
    {

       $request->validate([
            'partenaire-name' => 'required',
        ]);
    
    
        if ($request->hasFile('partenaire-logo') && $request->file('partenaire-logo')->isValid()) {
            $file_name = time() . '.' . $request->file('partenaire-logo')->getClientOriginalExtension();
            $request->file('partenaire-logo')->move(public_path('images/pdp-partenaire'), $file_name);
          
        }   
        else {
            $file_name =$request->hidden_partenaire_logo; 
        }
     
        $partenaire= Partenaire::find($request->hidden_id);
        $partenaire->nom_partenaire = $request->input('partenaire-name');
        $partenaire->histoire_partenaire = $request->input('partenaire-histo');
        $partenaire->abbrev_partenaire = $request->input('partenaire-abr');
        $partenaire->siteOff_partenaire = $request->input('partenaire-url');
        $partenaire->date_relation_partenaire = $request->input('partenaire-date');
        $partenaire->logo_partenaire = $file_name;
    
        $partenaire->save();
    
        return redirect()->route('partenaire.index')->with('success', 'partenaire modifier avec succès');
    }

   
}


