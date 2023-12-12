<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use App\Models\Partenaire;
use App\Models\publication;
use App\Models\Commentaire;
use App\Models\ImpactValue;
use App\Models\Membre;
use App\Models\Objectif;
use App\Models\Photo;
use App\Models\Project;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected $viewsCounterController;

  /*   public function __construct(ViewsCounterController $viewsCounterController)
    {
        $this->viewsCounterController = $viewsCounterController;
    } */

    public function acceuil(Request $request){
        $blogs = Blog::select('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog','blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
        ->selectRaw('(SELECT COUNT(id) FROM commentaires WHERE commentaires.blog_id = blogs.id) as comment_count')
        ->groupBy('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog', 'blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
        ->Where("blogs.status_blog", "=", "publier")
        ->orderBy('blogs.date_publi_blog', 'desc')
        ->get();


        $partenaires = Partenaire::select('*')
        ->Where("status_partenaire", "=", "publier")
        ->orderBy('date_relation_partenaire', 'desc')
        ->limit(3)
        ->get();

        return view('visiteur.pages.acceuil.acceuil', compact('blogs','partenaires'));
    }


    public function CommentPubliZone($id){
        $blog = Blog::findOrFail($id);
        $photos = Photo::where('blogs_id', $id)->get();
        $comment = Commentaire::select('commentaires.*','visiteurs.nom_visiteur', 'visiteurs.mail_visiteur')
        ->leftJoin('blogs', 'blogs.id', '=', 'commentaires.blog_id')
        ->leftJoin('visiteurs', 'visiteurs.id', '=', 'commentaires.visiteur_id')
        ->selectRaw('TIMESTAMPDIFF(SECOND, commentaires.created_at, NOW()) AS seconds_diff')
        ->where('blogs.id', $id)
        ->orderBy('commentaires.created_at', 'asc')
        ->get();

        return view('visiteur.pages.acceuil.commentZone', [
            'blog' => $blog ,
            'photos'=> $photos,
            'comments' =>$comment
        ]);
    }

    public function blog_reportage(Request $request){
        $keyword = $request->get('search');
        $perPage = 20;

        if (!empty($keyword)) {
            $blogs = Blog::select('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog','blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->selectRaw('(SELECT COUNT(id) FROM commentaires WHERE commentaires.blog_id = blogs.id) as comment_count')
                ->groupBy('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog', 'blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->Where("blogs.status_blog", "=", "publier")
                ->where("blogs.type_blog", "=", "Publication")
                ->where("blogs.titre_blog", "LIKE", "%$keyword%")
                ->OrWhere("blogs.sous_titre_blog", "LIKE", "%$keyword%")
                ->orderBy('blogs.created_at', 'desc')
                ->paginate($perPage);

            $reportages = Blog::select('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog','blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->selectRaw('(SELECT COUNT(id) FROM commentaires WHERE commentaires.blog_id = blogs.id) as comment_count')
                ->groupBy('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog', 'blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->Where("blogs.status_blog", "=", "publier")
                ->where("blogs.type_blog", "=", "Reportage")
                ->where("blogs.titre_blog", "LIKE", "%$keyword%")
                ->OrWhere("blogs.sous_titre_blog", "LIKE", "%$keyword%")
                ->orderBy('blogs.date_publi_blog', 'desc')
                ->paginate($perPage);

        } else {
            $blogs = Blog::select('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog','blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->selectRaw('(SELECT COUNT(id) FROM commentaires WHERE commentaires.blog_id = blogs.id) as comment_count')
                ->groupBy('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog', 'blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->Where("blogs.status_blog", "=", "publier")
                ->where("blogs.type_blog", "=", "Publication")
                ->orderBy('blogs.date_publi_blog', 'desc')
                ->paginate($perPage);

            $reportages = Blog::select('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog','blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->selectRaw('(SELECT COUNT(id) FROM commentaires WHERE commentaires.blog_id = blogs.id) as comment_count')
                ->groupBy('blogs.id', 'blogs.titre_blog', 'blogs.sous_titre_blog', 'blogs.contenu_blog', 'blogs.type_blog', 'blogs.url_blog', 'blogs.couv_blog', 'blogs.status_blog', 'blogs.date_publi_blog')
                ->Where("blogs.status_blog", "=", "publier")
                ->where("blogs.type_blog", "=", "Reportage")
                ->orderBy('blogs.date_publi_blog', 'desc')
                ->paginate($perPage);
        }

         return view('visiteur.pages.blogs.blogList', compact('blogs', 'reportages'));
    }

    public function domain(Request $request)
    {
        $impactValues = ImpactValue::first();
        return view('visiteur.pages.domaine.domain', compact('impactValues'));
    }

    public function project(Request $request){
        $projects = Project::where('status_project', 'publier')->get();

        $photos = Photo::whereIn('project_id', $projects->pluck('id'))->get();
        $objectif = Objectif::whereIn('project_id', $projects->pluck('id'))->get();

        $countObjDone = Objectif::whereIn('project_id', $projects->pluck('id'))->where('status_obj', 'Done')->count();
        $countObj = Objectif::whereIn('project_id', $projects->pluck('id'))->count();

        $percentDone = ($countObj > 0) ? ($countObjDone * 100 / $countObj) : 0;

        return view('visiteur.pages.project.project', compact('projects', 'photos', 'objectif', 'percentDone'));
    }


    public function partenaire(Request $request)
    {
        $partenaires = partenaire::select('*')->get();
        return view('visiteur.pages.partenaires.index',compact('partenaires'));
    }

    public function about(Request $request)
    {
        $membre = Membre::select('*')->get();
        return view('visiteur.pages.about.about',compact('membre'));
    }

    public function don(Request $request)
    {
        return view('visiteur.pages.don.don');
    }















    public function Reportage(){
        return view('visiteur.pages.reportage');
    }

    public function History(){
        return view('visiteur.pages.history');
    }

   }


































