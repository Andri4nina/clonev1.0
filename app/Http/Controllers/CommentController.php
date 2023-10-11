<?php

namespace App\Http\Controllers;
use App\Models\publication;
use App\Models\Visiteur;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        // Validation des champs requis dans la requête
        $request->validate([
            'nom_vis' => 'required',
            'email_vis' => 'required',
            'tel_vis' => 'required',
            'contenu_com' => 'required',
        ]);
    
        // Vérifier si le visiteur existe déjà par son adresse e-mail
        $existingVisitor = Visiteur::where('email_vis', $request->email_vis)->first();
    
        if (!$existingVisitor) {
            // Le visiteur n'existe pas, alors créons un nouveau visiteur
            $visiteur = new Visiteur();
            $visiteur->nom_vis = $request->nom_vis;
            $visiteur->email_vis = $request->email_vis;
            $visiteur->tel_vis = $request->tel_vis;
            $visiteur->save(); // Enregistrement du nouveau visiteur
        } else {
            // Le visiteur existe déjà, pas besoin d'ajouter un nouveau
            $visiteur = $existingVisitor;
        }
    
        // Création d'un nouveau commentaire
        $comment = new Commentaire();
        $comment->id_publi = $request->hidden_id; // Assurez-vous que hidden_id est présent dans le formulaire
        $comment->contenu_com = $request->contenu_com;
        $comment->id_vis = $visiteur->id; // Liaison du commentaire avec le visiteur
        $comment->save(); // Enregistrement du commentaire
    
        return back()->with('success', 'votre commentaire est maintennt visible par tous le monde ');
    }

    public function DelCom($id){
        $comment= Commentaire::findOrFail($id);
        $comment->delete();
        return back()->with('success','commentaire supprimer!');
    }
    
}
