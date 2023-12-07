<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Partenaire;
use App\Models\Project;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{

    public function index(Request $request)
    {
        $keywordblog = $request->get('searchblog');
        $perPage = 10;

        if (!empty($keywordblog)) {
            $blogs = Blog::join('users', 'blogs.user_id', '=', 'users.id')
                ->select('blogs.*', 'users.name as author_name')
                ->where("blogs.titre_blog", "LIKE", "%$keywordblog%")   
                ->where("blogs.status_blog", "LIKE","Archiver")      
                ->orderBy('blogs.created_at', 'desc')
                ->paginate($perPage);
        } else {
            $blogs = Blog::join('users', 'blogs.user_id', '=', 'users.id')
                ->select('blogs.*', 'users.name as author_name')
                ->where("blogs.status_blog", "LIKE","Archiver")   
                ->orderBy('blogs.created_at', 'desc')
                ->paginate($perPage);
        }
  

        $keywordPart = $request->get('searchpart');

        if (!empty($keywordPart)) {
            $partenaire = Partenaire::select('partenaires.id','partenaires.nom_partenaire','partenaires.abbrev_partenaire','partenaires.histoire_partenaire','partenaires.siteOff_partenaire','partenaires.logo_partenaire','partenaires.status_partenaire','partenaires.date_relation_partenaire')
                ->where("partenaires.nom_partenaire", "LIKE", "%$keywordPart%")         
                ->orWhere("partenaires.abbrev_partenaire", "LIKE", "%$keywordPart%")
                ->where("partenaires.status_partenaire" , "LIKE" , "Archiver")
                ->orderBy('partenaires.id', 'desc')
                ->paginate($perPage);

        } else {
            $partenaire = Partenaire::select('partenaires.id','partenaires.nom_partenaire','partenaires.abbrev_partenaire','partenaires.histoire_partenaire','partenaires.siteOff_partenaire','partenaires.logo_partenaire','partenaires.status_partenaire','partenaires.date_relation_partenaire')
            ->where("partenaires.status_partenaire" , "LIKE" , "Archiver")
            ->paginate($perPage);
        }

        $keywordProj = $request->get('searchproj');
        
        if (!empty($keywordProj)) {
            $project = Project::select('projects.*')
                ->where("projects.titre_project", "LIKE", "%$keywordProj%")  
                ->where("projects.status_project", "LIKE" , "Archiver")   
                ->orderBy('project.created_at', 'desc')
                ->paginate($perPage);
        } else {
            $project = Project::select('projects.*')
                ->select('projects.*')
                ->where("projects.status_project", "LIKE" , "Archiver")  
                ->orderBy('projects.created_at', 'desc')
                ->paginate($perPage);
        }
        
        return view('archive.index', compact('blogs','partenaire','project'))
        ->with('i', ($request->input('page', 1) - 1) * $perPage);
    }
}
