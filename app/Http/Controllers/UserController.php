<?php

namespace App\Http\Controllers;

use App\Models\publication;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 10;
        if (!empty($keyword)) {
            $utilisateur = User::select('users.id','users.name','users.email','users.status_user','users.role_user')
                ->selectRaw('COUNT(publications.id) AS total_publications')
                ->selectRaw('DATEDIFF(CURDATE(), users.created_at) AS anciennete')
                ->leftJoin('publications', 'users.id', '=', 'publications.id_user')
                ->groupBy('users.id', 'users.name', 'users.email', 'users.status_user', 'users.role_user','anciennete')
                

                ->where("name", "LIKE", "%$keyword%")         
                ->orWhere("role_user", "LIKE", "%$keyword%")
                ->orderBy('users.id', 'desc')
                ->paginate($perPage);
        } else {
            $utilisateur = User::select('users.id','users.name','users.email','users.status_user','users.role_user')
            ->selectRaw('COUNT(publications.id) AS total_publications')
            ->selectRaw('DATEDIFF(CURDATE(), users.created_at) AS anciennete')
            ->leftJoin('publications', 'users.id', '=', 'publications.id_user')
            ->groupBy('users.id', 'users.name', 'users.email', 'users.status_user', 'users.role_user','anciennete')          
            ->paginate($perPage);
        }

   
        return view('utilisateur.index',['utilisateur' => $utilisateur]) ->with('i', (request()->input('page', 1) -1) *5);
    }


    public function create()
    {
        return view('utilisateur.create');
    }


    public function store(Request $request)
    {
   
        $request->validate([
            'name'=>'required'
        ]);
        $utilisateur= new User();
        $utilisateur->name = $request->name;
        $utilisateur->email = $request->email;
        $utilisateur->password = $request->password;
        $utilisateur->role_user = $request->role_user;
        

        $utilisateur->prvlg_creation_super_user = $request->has('check_crea_super');
        $utilisateur->prvlg_suppression_super_user = $request->has('check_suppr_super');
        $utilisateur->prvlg_creation_user = $request->has('check_creat_user');
        $utilisateur->prvlg_suppression_user = $request->has('check_suppr_user');
        $utilisateur->prvlg_approb_blog = $request->has('check_approb_blog');
        $utilisateur->prvlg_publi_blog = $request->has('check_gest_blog');
        $utilisateur->prvlg_creation = $request->has('check_creat');
        $utilisateur->prvlg_suppression = $request->has('check_suppr');
        $utilisateur->prvlg_modification = $request->has('check_modif');
        
        $utilisateur->save();
        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur creer avec succes');
    }

    public function edit($id){
        $utilisateur = User::findOrfail($id);
        return view ('utilisateur.edit',['utilisateur' => $utilisateur]);
    }


    public function update(Request $request, User $utilisateur){
        
        $request->validate([
            'name'=>'required'
        ]);

        $utilisateur= User::find($request->hidden_id);
        $utilisateur->name = $request->name;
        $utilisateur->email = $request->email;
        $utilisateur->role_user = $request->role_user;
        
        $utilisateur->prvlg_creation_super_user = $request->has('check_crea_super');
        $utilisateur->prvlg_suppression_super_user = $request->has('check_suppr_super');
        $utilisateur->prvlg_creation_user = $request->has('check_creat_user');
        $utilisateur->prvlg_suppression_user = $request->has('check_suppr_user');
        $utilisateur->prvlg_approb_blog = $request->has('check_approb_blog');
        $utilisateur->prvlg_publi_blog = $request->has('check_gest_blog');
        $utilisateur->prvlg_creation = $request->has('check_creat');
        $utilisateur->prvlg_suppression = $request->has('check_suppr');
        $utilisateur->prvlg_modification = $request->has('check_modif');
  
        $utilisateur->save();

        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur modifier avec succes');
    }

    public function destroy($id){
        $utilisateur= User::findOrFail($id);
        $utilisateur->delete();
        return redirect('utilisateur')->with('success','Utilisateur supprimer!');
    }


    public function show($id) {
        $utilisateur = User::findOrFail($id);
    
        $countUtilisateurCreation = publication::where('id_user', '=', $id)->count();
        $countAllCreation = publication::count();
    
        $countUtilisateurPublication = publication::where('status_publi', 'LIKE', 'Publier')
                                                ->where('id_user', '=', $id)
                                                ->count();
        $countAllPublication = publication::where('status_publi', 'LIKE', 'Publier')->count();
    
        return view('utilisateur.profil', ['utilisateur' => $utilisateur,'countUtilisateurCreation' => $countUtilisateurCreation,'countAllCreation' => $countAllCreation,'countUtilisateurPublication' => $countUtilisateurPublication,'countAllPublication' => $countAllPublication,]);
    }
    
    public function mode(Request $request, User $utilisateur){


        $utilisateur =User::find($request->hidden_id);
        $mode=$request->hidden_mode;
        if($mode=='light'){
            $utilisateur->mode_user= "dark";
        }else{
            $utilisateur->mode_user='light';
        }

        $utilisateur->save();
        return back();
    }


    public function theme(Request $request, User $utilisateur){
        $utilisateur =User::find($request->hidden_id);       
        $theme=$request->hidden_theme;
        $utilisateur->theme_user=$theme;
        $utilisateur->save();
        return back();
    } 


}
