<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use App\Models\ImpactValue;
use App\Models\Tache;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $tacheDone = Tache::select('taches.*')
            ->where('taches.status_task','Terminer')
            ->orderBy('taches.created_at', 'desc')
            ->get();
    
        $tacheProgress = Tache::select('taches.*')
            ->where('taches.status_task','En progression')
            ->orderBy('taches.created_at', 'desc')
            ->get();
    
        $tachereview = Tache::select('taches.*')
            ->where('taches.status_task','En revision')
            ->orderBy('taches.created_at', 'desc')
            ->get();
    
        $tache = Tache::select('taches.*')
            ->where('taches.status_task','En attente')
            ->orderBy('taches.created_at', 'desc')
            ->get();

        $impactValues = ImpactValue::first();
        $totalGeneral = $impactValues->enfants + $impactValues->adolescents + $impactValues->adultes;

        return view('tache.index', compact('tacheDone', 'tacheProgress', 'tachereview', 'tache','impactValues','totalGeneral'));
    }

    public function incrementImpactValues(Request $request)
    {
        $impactValues = ImpactValue::first();

        $impactValues->enfants += $request->input('enfants');
        $impactValues->adolescents += $request->input('adolescents');
        $impactValues->adultes += $request->input('adultes');

        $impactValues->save();

        return redirect()->back()->with('success', ' Ajoute des nouveaux chiffre avec succes!');
    }
    

    public function storeUpdate(Request $request){
        $request->validate([
            'tache-titre' => 'required',
        ]);
    
        $tache = null; 
        
        if($request->has('hidden_id')){
            $tache = Tache::find($request->hidden_id);
        }
    
        if($tache){
            $tache->libelle_task = $request->input('tache-titre');
            $tache->save();
            return redirect()->back()->with('success', 'Tâche mise à jour avec succès');
        } else {
            $tache = new Tache();
            $tache->libelle_task = $request->input('tache-titre');
            $tache->save();
            return redirect()->back()->with('success', 'Nouvelle tâche créée avec succès');
        }
    
    }
    

    public function destroy ($id){
        $tache= Tache::findOrFail($id);

        $tache->delete();
        return redirect()->back()->with('success', 'Tâche supprimer avec succès');
    }

    public function review ($id){
        $tache= Tache::findOrFail($id);
        $tache->status_task = 'En revision';
        $historique = "'La tache ".$tache->libelle_task . " est en revision '";
      
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        $tache->save();
        return redirect()->back()->with('success', 'Tâche en revision');
    }


    public function done ($id){
        $tache= Tache::findOrFail($id);
        $tache->status_task = 'Terminer';
        $tache->save();
        $historique = "'La tache ".$tache->libelle_task . " est accomplis '";
      
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();

        return redirect()->back()->with('success', 'Tâche accomplis');
    }

    public function progress (Request $request,$id){
        $tache= Tache::findOrFail($id);
        $tache->status_task = 'En progression';
        $historique = $request->input('the_user') . " a effectuer la tache '" .  $tache->libelle_task . "'";
      
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        $tache->save();
        return redirect()->back()->with('success', 'Tâche en progression');
    }
}
