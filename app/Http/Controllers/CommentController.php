<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Visiteur;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storepublic(Request $request){
        // Validation des champs requis dans la requête
        $request->validate([
            'nom_vis' => 'required',
            'email_vis' => 'required',
            'contenu_com' => 'required',
        ]);
    
        // Vérifier si le visiteur existe déjà par son adresse e-mail
        $existingVisitor = Visiteur::where('mail_visiteur', $request->email_vis)->first();
    
        if (!$existingVisitor) {
            // Le visiteur n'existe pas, alors créons un nouveau visiteur
            $visiteur = new Visiteur();
            $visiteur->nom_visiteur = $request->nom_vis;
            $visiteur->mail_visiteur = $request->email_vis;
            $visiteur->save(); // Enregistrement du nouveau visiteur
        } else {
            // Le visiteur existe déjà, pas besoin d'ajouter un nouveau
            $visiteur = $existingVisitor;
        }
    
        // Création d'un nouveau commentaire
        $comment = new Commentaire();
        $comment->blog_id = $request->hidden_id; // Assurez-vous que hidden_id est présent dans le formulaire
        $comment->libelle_com = $request->contenu_com;
        $comment->type_com = 'commentaire_publi';
        $comment->visiteur_id = $visiteur->id; // Liaison du commentaire avec le visiteur
        $comment->save(); // Enregistrement du commentaire
    
        return back()->with('success', 'votre commentaire est maintennt visible par tous le monde ');
    }

    public function storeresponse(Request $request){
        // Validation des champs requis dans la requête
        $request->validate([
            'contenu_com' => 'required',
        ]);
        // Création d'un nouveau commentaire
        $comment = new Commentaire();
        $comment->blog_id = $request->hidden_id; // Assurez-vous que hidden_id est présent dans le formulaire
        $comment->libelle_com = $request->contenu_com;
        $comment->type_com = 'response';
        $comment->save(); // Enregistrement du commentaire
    
        return back()->with('success', 'votre commentaire est maintennt visible par tous le monde ');
    }

     public function DelCom($id){
        $comment= Commentaire::findOrFail($id);
        $comment->delete();
        return back()->with('success','commentaire supprimer!');
    } 
    
}
