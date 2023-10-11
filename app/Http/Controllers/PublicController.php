<?php

namespace App\Http\Controllers;
use Carbon\Carbon; 
use App\Models\Partenaire;
use App\Models\publication;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    protected $viewsCounterController;

    public function __construct(ViewsCounterController $viewsCounterController)
    {
        $this->viewsCounterController = $viewsCounterController;
    }
    public function acceuil(Request $request){
      
        $this->viewsCounterController->ajouter_vue();

    
        return view('visiteur.pages.acceuil');
    }


    public function domain(Request $request)
    {  
        return view('visiteur.pages.domain');
    } 

    public function project(Request $request)
    {  
        return view('visiteur.pages.project');
    } 

    public function about(Request $request)
    {  
        return view('visiteur.pages.about');
    } 

    public function don(Request $request)
    {  
        return view('visiteur.pages.don');
    } 












    public function CommentPubliZone($id){
        return view('visiteur.pages.commentZone');
    }
     
    
    public function Reportage(){
        return view('visiteur.pages.reportage');
    }

    public function History(){
        return view('visiteur.pages.history');
    }

   }































   


 