<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;
        if (!empty($keyword)) {
            $partenaire = Partenaire::select('*')    
                ->where("nom", "LIKE", "%$keyword%")         
                ->orWhere("abreviation", "LIKE", "%$keyword%")
                ->orWhere("status_part", "LIKE", "%$keyword%")
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } else {
            $partenaire = Partenaire::select('*')   
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
        }

        
        return view('partenaire.index', ['partenaire' => $partenaire]) ->with('i', (request()->input('page', 1) -1) *5);
    }


    public function create(){
        return view('partenaire.create');
    }


    public function store(Request $request)
    {
   
        $request->validate([
            'nom'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $partenaire = new partenaire;
        $partenaire->nom = $request->nom;
        $partenaire->abreviation = $request->Abreviation;
        $partenaire->histoire = $request->Histoire;
        $partenaire->url = $request->url;
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/logo'), $file_name);
            $partenaire->logo = $file_name;
        }
  

        $partenaire->save();
        return redirect()->route('partenaire.index')->with('success', 'Partenaire creer avec succes');
    }

    
    public function edit($id){
        $partenaire = Partenaire::findOrfail($id);
        return view('partenaire.edit',['partenaire' => $partenaire]);
    }

    public function update(Request $request, Partenaire $partenaire){
        
        $request->validate([
            'nom'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
       
        $partenaire->nom = $request->nom;
        $partenaire->abreviation = $request->Abreviation;
        $partenaire->histoire = $request->Histoire;
        $partenaire->url = $request->url;
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/logo'), $file_name);
            $partenaire->logo = $file_name;
        }
        else if($request->image == ''){
            $file_name =$request->hidden_logo_image; 
        }
  

        $partenaire->save();
        return redirect()->route('partenaire.index')->with('success', 'Partenaire modifier avec succes');
    }


    public function destroy($id){
        $partenaire = partenaire::findOrFail($id);
        $image_path = public_path()."/images/logo/";  
        $image= $image_path. $partenaire->img_logo_publi;
        if(file_exists($image)){
            @unlink($image);
        }
        $partenaire->delete();
        return redirect('partenaire')->with('success','Partenaire supprimer!');
    }


    public function show($id){
        $partenaire = Partenaire::findOrfail($id);
        return view ('partenaire.show',['partenaire' => $partenaire]);

    }

    public function approved(Request $request, Partenaire $partenaire){

        $partenaire = Partenaire ::find($request->hidden_id);
        $partenaire->status_part = $request->status_part;
        $partenaire->save();
        return redirect()->route('partenaire.index')->with('success', 'Partenaire approuver,vous pouvez maintenant afficher le partenaire dans la page');
    }

    public function publish(Request $request, Partenaire $Partenaire){

        $partenaire = Partenaire::find($request->hidden_id);
   
        
        if ($request->input('status') == "on") {
            $partenaire->status_part = 'Publier';
        } else {
            $partenaire->status_part = 'Archiver';
        }
    
        $partenaire->save();
        $message = $partenaire->status_part === 'Publier' ? 'Partenaire affiche' : 'Partenaire archivé';

        return redirect()->route('partenaire.index')->with('success',$message);
    }

}
