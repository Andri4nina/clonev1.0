<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\publication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;
        if (!empty($keyword)) {
            $publication = Publication::join('users', 'publications.id_user', '=', 'users.id')
                ->select('publications.*', 'users.name')    
                ->where("titre_publi", "LIKE", "%$keyword%")         
                ->orWhere("status_publi", "LIKE", "%$keyword%")
                ->orWhere("name", "LIKE", "%$keyword%")
                ->orderBy('publications.created_at', 'desc')
                ->paginate($perPage);
        } else {
            $publication = Publication::join('users', 'publications.id_user', '=', 'users.id')
            ->select('publications.*', 'users.name')
            ->orderBy('publications.created_at', 'desc')
            ->paginate($perPage);
        }

        
        return view('publication.index', ['publication' => $publication]) ->with('i', (request()->input('page', 1) -1) *5);
    }
    
    public function create()
    {
        return view('publication.create');
    }

    public function store(Request $request)
    {
   
        $request->validate([
            'titre_publi'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $publication = new publication;
        $publication->titre_publi = $request->titre_publi;
        $publication->sous_titre_publi = $request->sous_titre_publi;
        $publication->contenu_publi = $request->contenu_publi;
       /*  $publication->piece_jointe_publi=$request->piece_jointe_publi; */
         $publication->id_user=$request->id_user;
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/couverture'), $file_name);
            $publication->img_couv_publi = $file_name;
        }
  

        $publication->save();
        return redirect()->route('publication.index')->with('success', 'Blog creer avec succes');
    }



    public function edit($id){
        $publication = publication::findOrfail($id);
        return view ('publication.edit',['publication' => $publication]);
    }

    public function update(Request $request, publication $publication){
        
        $request->validate([
            'titre_publi'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);



        if($request->image != ''){
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/couverture'), $file_name);
        }
        else if($request->image == ''){
            $file_name =$request->hidden_publi_image; 
        }

        $publication = publication ::find($request->hidden_id);

        $publication->titre_publi = $request->titre_publi;
        $publication->sous_titre_publi = $request->sous_titre_publi;
        $publication->contenu_publi = $request->contenu_publi;
        $publication->titre_publi = $request->titre_publi;
        $publication->img_couv_publi = $file_name;
  

        $publication->save();

        return redirect()->route('publication.index')->with('success', 'Blog modifier avec succes');
    }



    public function destroy($id){
        $publication = publication::findOrFail($id);
        $image_path = public_path()."/images/couverture/";  
        $image= $image_path. $publication->img_couv_publi;
        if(file_exists($image)){
            @unlink($image);
        }
        $publication->delete();
        return redirect('publication')->with('success','Blog supprimer!');
    }


    public function show($id){
        $publication = publication::findOrfail($id);
        return view ('publication.show',['publication' => $publication]);

    }

    public function approved(Request $request, publication $publication){

        $publication = publication ::find($request->hidden_id);
        $publication->status_publi = $request->status_publi;
        $publication->save();
        return redirect()->route('publication.index')->with('success', 'Blog approuver,vous pouvez maintenant publier le blog');
    }

    public function publish(Request $request, publication $publication){

        $publication = publication ::find($request->hidden_id);

        $publication->date_publi = date('Y-m-d H:i:s');
        if ($request->input('status') == "on") {
            $publication->status_publi = 'Publier';
        } else {
            $publication->status_publi = 'Archiver';
        }
    
        $publication->save();
        $message = $publication->status_publi === 'Publier' ? 'Blog publié' : 'Blog archivé';

        return redirect()->route('publication.index')->with('success',$message);
    }

}
