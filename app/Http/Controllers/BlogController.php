<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Galerie;
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

    public function destroy($id){
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
        $blog->delete();
    
        return redirect('blog')->with('success','Blog supprimé!');
    }
    

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        $photos = Photo::where('blogs_id', $id)->get();
        
        return view('blog.show', ['blog' => $blog, 'photos' => $photos]);
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
        
        return redirect()->route('blog.index')->with('success', "Blog créé avec succès ,attendons l'approbation de nos superieurs");

    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'blog-titre' => 'required',
            'blog-contenu' => 'required',
            'blog-couv' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $blog = Blog::findOrFail($id);
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
    
        return redirect()->route('blog.index')->with('success', "Blog mis à jour avec succès, en attente d'approbation de nos supérieurs");
    }
    
/* 
    public function show()
    {
        
    }
 */










}
