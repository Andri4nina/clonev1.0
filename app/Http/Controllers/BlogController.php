<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Commentaire;
use App\Models\Galerie;
use App\Models\Historique;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BlogController extends Controller
{
    // 
    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 10;
        
        if (!empty($keyword)) {
            $blogs = Blog::join('users', 'blogs.user_id', '=', 'users.id')
                ->select('blogs.*', 'users.name as author_name')
                ->where("blogs.titre_blog", "LIKE", "%$keyword%")         
                ->orWhere("blogs.status_blog", "LIKE", "%$keyword%")
                ->orderBy('blogs.created_at', 'desc')
                ->paginate($perPage);
        } else {
            $blogs = Blog::join('users', 'blogs.user_id', '=', 'users.id')
                ->select('blogs.*', 'users.name as author_name')
                ->orderBy('blogs.created_at', 'desc')
                ->paginate($perPage);
        }
        
        return view('blog.index', compact('blogs'))
        ->with('i', ($request->input('page', 1) - 1) * $perPage);
    }


    public function create()
    {
        return view('blog.create');
    }

    public function edit($id)
    { 
        $blog = Blog::findOrFail($id);
        $photos = Photo::where('blogs_id', $id)->get();
        
        return view('blog.edit', ['blog' => $blog, 'photos' => $photos]);
    }

    public function destroy(Request $request,$id){
        $blog = Blog::findOrFail($id);
        $image_path = public_path("images/couv-blog/");  
        $image = $image_path . $blog->couv_blog;
        if(file_exists($image)){
            @unlink($image);
        }
        $photos = Photo::where('blogs_id', $id)->get();
        foreach($photos as $photo){
            $photo->delete();
        }

        $historique = $request->input('the_user') . " a supprimer le blog '" . $blog->titre_blog . "'";
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
      
        $blog->delete();
    
        return redirect('blog')->with('success','Blog supprimé!');
    }
    

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $photos = Photo::where('blogs_id', $id)->get();
        $comment = Commentaire::select('commentaires.*','visiteurs.nom_visiteur', 'visiteurs.mail_visiteur')
        ->leftJoin('blogs', 'blogs.id', '=', 'commentaires.blog_id')
        ->leftJoin('visiteurs', 'visiteurs.id', '=', 'commentaires.visiteur_id')
        ->selectRaw('TIMESTAMPDIFF(SECOND, commentaires.created_at, NOW()) AS seconds_diff')
        ->where('blogs.id', $id)
        ->orderBy('commentaires.created_at', 'asc')
        ->get();
        
        return view('blog.show', ['blog' => $blog, 'photos' => $photos,'comment'=>$comment]);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'blog-titre' => 'required',
            'blog-contenu' => 'required',
            'blog-couv' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $blog = new Blog();
        $blog->titre_blog = $request->input('blog-titre');
        $blog->sous_titre_blog = $request->input('blog-soustitre');
        $blog->contenu_blog = $request->input('blog-contenu');
        $blog->type_blog = $request->input('blog-type');
        $blog->url_blog = $request->input('blog-url');
        $blog->user_id = $request->input('adderId');
        
        if ($request->hasFile('blog-couv') && $request->file('blog-couv')->isValid()) {
            $file_name = time() . '.' . $request->file('blog-couv')->getClientOriginalExtension();
            $request->file('blog-couv')->move(public_path('images/couv-blog'), $file_name);
            $blog->couv_blog = $file_name; 
        } else {
            $blog->couv_blog = 'noimg.png';
        }
        
        $blog->save();
        
        $date_galerie = now()->format('Y-m-d'); // Obtenir la date d'aujourd'hui au format YYYY-MM-DD
        $galerie = null;
        $existing_galerie = Galerie::where('date_galerie', $date_galerie)->first();
        
        if ($existing_galerie) {
            $galerie_id = $existing_galerie->id;
        } else {
            $galerie = new Galerie();
            $galerie->date_galerie = $date_galerie;
            $galerie->save();
            $galerie_id = $galerie->id;
        }
        
        $countnbimg = $request->input('nbrphoto');
        
        for ($i = 1; $i <= $countnbimg; $i++) {
            if ($request->hasFile('photo'.$i) && $request->file('photo'.$i)->isValid()) {
                $file_name = time() . '_' . $i . '.' . $request->file('photo'.$i)->getClientOriginalExtension();
                $request->file('photo'.$i)->move(public_path('images/galerie/'.$date_galerie), $file_name);
                $photo = new Photo();
                $photo->img = 'images/galerie/'.$date_galerie.'/'.$file_name;
                $photo->blogs_id = $blog->id;
                $photo->galerie_id = $galerie ? $galerie->id : $galerie_id;
                $photo->save();
            }
        }
        
        $historique = $request->input('the_user') . " a créé le blog '" . $request->input('blog-titre') . "'";
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        

        return redirect()->route('blog.index')->with('success', "Blog créé avec succès ,attendons l'approbation de nos superieurs");

    }
    
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'blog-titre' => 'required',
            'blog-contenu' => 'required',
            'blog-couv' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $blog= Blog::find($request->hidden_id);
        $blog->titre_blog = $request->input('blog-titre');
        $blog->sous_titre_blog = $request->input('blog-soustitre');
        $blog->contenu_blog = $request->input('blog-contenu');
        $blog->type_blog = $request->input('blog-type');
        $blog->url_blog = $request->input('blog-url');
        $blog->user_id = $request->input('adderId');
    
        if ($request->hasFile('blog-couv') && $request->file('blog-couv')->isValid()) {
            $file_name = time() . '.' . $request->file('blog-couv')->getClientOriginalExtension();
            $request->file('blog-couv')->move(public_path('images/couv-blog'), $file_name);
            $blog->couv_blog = $file_name;
        }
    
        $blog->save();
    
        $date_galerie = now()->format('Y-m-d'); // Obtenir la date d'aujourd'hui au format YYYY-MM-DD
        $galerie = null;
        $existing_galerie = Galerie::where('date_galerie', $date_galerie)->first();
    
        if ($existing_galerie) {
            $galerie_id = $existing_galerie->id;
        } else {
            $galerie = new Galerie();
            $galerie->date_galerie = $date_galerie;
            $galerie->save();
            $galerie_id = $galerie->id;
        }
    
        $countnbimg = $request->input('nbrphoto');
    
        for ($i = 1; $i <= $countnbimg; $i++) {
            if ($request->hasFile('photo'.$i) && $request->file('photo'.$i)->isValid()) {
                $file_name = time() . '_' . $i . '.' . $request->file('photo'.$i)->getClientOriginalExtension();
                $request->file('photo'.$i)->move(public_path('images/galerie/'.$date_galerie), $file_name);
                $photo = new Photo();
                $photo->img = 'images/galerie/'.$date_galerie.'/'.$file_name;
                $photo->blogs_id = $blog->id;
                $photo->galerie_id = $galerie ? $galerie->id : $galerie_id;
                $photo->save();
            }
        }
        
        $ids = explode(',', $request->input('del_value'));
        Photo::whereIn('id', $ids)->delete();
        
        $historique = $request->input('the_user') . " a modifier le blog '" . $request->input('blog-titre') . "'";
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        

        return redirect()->route('blog.index')->with('success', "Blog mis à jour avec succès");
    }
    

    public function approuved(Request $request, Blog $blog)
    {
        $blog= Blog::find($request->hidden_id);
        $blog->status_blog ='Approuve';
        
        $blog->save();
           
        $historique = $request->input('the_user') . " a approuver le blog '" . $blog->titre_blog . "'";
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        

        return redirect()->route('blog.index')->with('success', "Blog approuve avec succès");
    }



    public function publish(Request $request, Blog $blog)
    {
        $blog= Blog::find($request->hidden_id);
        if ($request->input('status') == "on") {
            $blog->status_blog = 'Publier';
            $blog->date_publi_blog=now();
            $historique = $request->input('the_user') . " a publier le blog '" . $blog->titre_blog . "'";
         
        
        } else {
            $blog->status_blog ='Archiver';
            $historique = $request->input('the_user') . " a archiver le blog '" . $blog->titre_blog. "'";
         
        }

        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();

        $blog->save();
        $message = $blog->status_blog === 'Publier' ? 'Blog publié' : 'Blog archivé';
        return redirect()->route('blog.index')->with('success',$message);
      }


   

}
