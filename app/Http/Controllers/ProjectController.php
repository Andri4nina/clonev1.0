<?php

namespace App\Http\Controllers;

use App\Models\Galerie;
use App\Models\Historique;
use App\Models\Objectif;
use App\Models\Partenaire;
use App\Models\Photo;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 10;

        if (!empty($keyword)) {
            $project = Project::select('projects.*')
                ->where("projects.titre_project", "LIKE", "%$keyword%")
                ->orderBy('project.created_at', 'desc')
                ->paginate($perPage);
        } else {
            $project = Project::select('projects.*')
                ->select('projects.*')
                ->orderBy('projects.created_at', 'desc')
                ->paginate($perPage);
        }

        return view('project.index', compact('project'))
        ->with('i', ($request->input('page', 1) - 1) * $perPage);


    }


    public function create()
    {
        return view('project.create');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $photos = Photo::where('project_id', $id)->get();
        $objectif = Objectif::where('project_id', $id)->get();

        return view('project.edit', ['project' => $project, 'photos' => $photos, 'objectif'=> $objectif]);

    }







    public function store(Request $request){
        $request->validate([
            'project-titre' => 'required',
            'project-contenu' => 'required',
        ]);

        $project = new Project();
        $project->titre_project = $request->input('project-titre');
        $project->contenu_project = $request->input('project-contenu');
        $project->zone_project = $request->input('project-location');

        $project->save();

        $historique = $request->input('the_user') . " a creer le project '" . $project->titre_project . "'";

        $histo = new Historique();
       $histo->descri_histo = $historique;
       $histo->save();


        $countnbimg = $request->input('nbrphoto');
        if($countnbimg >= 1){
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
        }


        for ($i = 1; $i <= $countnbimg; $i++) {
            if ($request->hasFile('photo'.$i) && $request->file('photo'.$i)->isValid()) {
                $file_name = time() . '_' . $i . '.' . $request->file('photo'.$i)->getClientOriginalExtension();
                $request->file('photo'.$i)->move(public_path('images/galerie/'.$date_galerie), $file_name);
                $photo = new Photo();
                $photo->img = 'images/galerie/'.$date_galerie.'/'.$file_name;
                $photo->project_id = $project->id;
                $photo->galerie_id = $galerie ? $galerie->id : $galerie_id;
                $photo->save();
            }
        }

        $countnbobj = $request->input('nbrobj');

        if($countnbobj>= 1){
            for ($i = 1; $i < $countnbobj; $i++) {
                $objectif = new Objectif();
                $objectif->project_id = $project->id;
                $objectif->libelle_obj=$request->input('objectif'. $i);
                $objectif->status_obj=('Phase');
                $objectif->save();
            }
        }

        return redirect()->route('project.index')->with('success', 'Project créé avec succès');

    }

    public function update(Request $request ,Project $project){
        $request->validate([
            'project-titre' => 'required',
            'project-contenu' => 'required',
        ]);



        $project= Project::find($request->hidden_id);
        $project->titre_project = $request->input('project-titre');
        $project->contenu_project = $request->input('project-contenu');
        $project->zone_project = $request->input('project-location');

        $project->save();

        $historique = $request->input('the_user') . " a mis a jour le project '" . $project->titre_project . "'";

        $histo = new Historique();
       $histo->descri_histo = $historique;
       $histo->save();

        $countnbimg = $request->input('nbrphoto');
        if($countnbimg >= 1){
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
        }





        for ($i = 1; $i <= $countnbimg; $i++) {
            if ($request->hasFile('photo'.$i) && $request->file('photo'.$i)->isValid()) {
                $file_name = time() . '_' . $i . '.' . $request->file('photo'.$i)->getClientOriginalExtension();
                $request->file('photo'. $i)->move(public_path('images/galerie/'.$date_galerie), $file_name);
                $photo = new Photo();
                $photo->img = 'images/galerie/'.$date_galerie.'/'.$file_name;
                $photo->project_id = $project->id;
                $photo->galerie_id = $galerie ? $galerie->id : $galerie_id;
                $photo->save();
            }
        }

        $countnbobj = $request->input('nbrobj');

        if($countnbobj>= 1){
            for ($i = 1; $i < $countnbobj; $i++) {
                $objectif = new Objectif();
                $objectif->project_id = $project->id;
                $objectif->libelle_obj=$request->input('objectif'. $i);
                $objectif->save();
            }
        }

        $ids1 = explode(',', $request->input('del_obj_value'));
        $ids2 = explode(',', $request->input('del_photo_value'));

        Objectif::whereIn('id', $ids1)->delete();
        Photo::whereIn('id', $ids2)->delete();

        return redirect()->route('project.index')->with('success', 'Project modifie avec succès');

    }

    public function publish(Request $request, Project $project)
    {
        $project= Project::find($request->hidden_id);
        if ($request->input('status') == "on") {
            $project->status_project = 'Publier';
            $historique = $request->input('the_user') . " a publier le project '" . $project->titre_project . "'";

            $project->date_publi_project=now();
        } else {
            $project->status_project ='Archiver';
            $historique = $request->input('the_user') . " a archiver le project '" . $project->titre_project . "'";

        }

         $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();

        $project->save();
        $message = $project->status_publi === 'Publier' ? 'Project publié' : 'Project archivé';
        return redirect()->route('project.index')->with('success',$message);
      }


    public function destroy(Request $request,$id){
        $project = Project::findOrFail($id);

        Photo::where('project_id', $id)->delete();
        Objectif::where('project_id', $id)->delete();
        $historique = $request->input('the_user') . " a supprimer le project '" . $project->titre_project . "'";
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();
        $project->delete();

        return redirect('project')->with('success','project supprimé!');
    }

    public function done(Request $request, Objectif $objectif){
        $objectif = Objectif::find($request->hidden_id);



        if ($request->has('status') && $request->input('status') == "on") {
            $objectif->status_obj = 'Done';
        } else {
            $objectif->status_obj = 'Phase';
        }

        $objectif->save();

        $message = $objectif->status_obj === 'Done' ? 'Objectif Atteint' : 'Objectif en révision';

        return redirect()->back()->with('success', $message);
       }



    public function show($id)
    {
        $project = Project::findOrFail($id);
        $photos = Photo::where('project_id', $id)->get();
        $objectif = Objectif::where('project_id', $id)->get();
        $countObjDone = Objectif::where('project_id', $id)->where('status_obj', 'Done')->count();
        $countObj = Objectif::where('project_id', $id)->count();

        $percentDone = $countObjDone * 100 / $countObj;

        return view('project.show', compact('project', 'photos', 'objectif', 'percentDone'));
    }

}

