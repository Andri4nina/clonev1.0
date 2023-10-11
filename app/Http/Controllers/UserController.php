<?php

namespace App\Http\Controllers;

use App\Models\publication;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('search');
        $perPage = 10;
        if (!empty($keyword)) {
            $user = User::select('users.id','users.name','users.email','users.status_user','users.role_user','users.pdp')
                ->selectRaw('DATEDIFF(CURDATE(), users.created_at) AS anciennete') 
                ->where("users.name", "LIKE", "%$keyword%")         
                ->orWhere("users.role_user", "LIKE", "%$keyword%")
                ->orderBy('users.id', 'desc')
                ->paginate($perPage);

        } else {
            $user = User::select('users.id','users.name','users.email','users.status_user','users.role_user','users.pdp')
            ->selectRaw('DATEDIFF(CURDATE(), users.created_at) AS anciennete')
            ->paginate($perPage);
        }

   
        return view('user.index',['utilisateur' => $user]) ->with('i', (request()->input('page', 1) -1) *5);
    }


    public function create()
    {
        return view('user.create');
    }

    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view ('user.edit',['user' => $user]);
    }


    public function profil()
    {
        return view('user.profil');
    }



    public function store(Request $request)
    {
       $request->validate([
            'user-name' => 'required',
            'user-mdp' => 'required|min:4',
            'user-pdp' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $user = new User();
    
        if ($request->hasFile('user-pdp') && $request->file('user-pdp')->isValid()) {
            $file_name = time() . '.' . $request->file('user-pdp')->getClientOriginalExtension();
            $request->file('user-pdp')->move(public_path('images/pdp'), $file_name);
            $user->pdp = $file_name;
        } else {
            $user->pdp = 'images/pdp/nopdp.png';
        }
    
        $user->email = $request->input('user-mail') . $request->input('user-mail-adresse');
        $user->name = $request->input('user-name');
        $user->password = bcrypt($request->input('user-mdp'));
        $user->tel_user = $request->input('user-tel');
        $user->status_user = 'hors-ligne';
        $user->theme_user = 'bleu';
        $user->mode_user = 'light';
        $user->role_user = $request->input('user-role');
        $user->prvlg_super_user = $request->has('super-user');
        $user->prvlg_task = $request->has('tache');
        $user->prvlg_create_user = $request->has('create-user');
        $user->prvlg_delete_user = $request->has('del-user');
        $user->prvlg_update_user = $request->has('updat-user');
        $user->prvlg_membre = $request->has('membre');
        $user->prvlg_project = $request->has('project');
        $user->prvlg_partenaire = $request->has('partenaire');
        $user->prvlg_create_blog = $request->has('create-blog');
        $user->prvlg_delete_blog = $request->has('del-blog');
        $user->prvlg_update_blog = $request->has('updat-blog');
        $user->prvlg_approv_blog = $request->has('approb-blog');
    
        $user->save();
    
        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur créé avec succès');
    }
    
    public function destroy($id){
        $user= User::findOrFail($id);
        $image_path = public_path()."/images/pdp/";  
        $image= $image_path. $user->pdp;
        if(file_exists($image)){
            @unlink($image);
        }
    
        $user->delete();
        return redirect('utilisateur')->with('success','Utilisateur supprimer!');
    }


    public function update(Request $request, User $user){
        
        $request->validate([
            'user-name'=>'required'
        ]);

         if ($request->hasFile('user-pdp') && $request->file('user-pdp')->isValid()) {
            $file_name = time() . '.' . $request->file('user-pdp')->getClientOriginalExtension();
            $request->file('user-pdp')->move(public_path('images/pdp'), $file_name);
         
        } else {
            $file_name =$request->hidden_user_pdp; 
        }

        $user= User::find($request->hidden_id);
        $user->pdp = $file_name;
        $user->email = $request->input('user-mail') . $request->input('user-mail-adresse');
        $user->name = $request->input('user-name');
        $user->tel_user = $request->input('user-tel');
        $user->role_user = $request->input('user-role');
        $user->prvlg_super_user = $request->has('super-user');
        $user->prvlg_task = $request->has('tache');
        $user->prvlg_create_user = $request->has('create-user');
        $user->prvlg_delete_user = $request->has('del-user');
        $user->prvlg_update_user = $request->has('updat-user');
        $user->prvlg_membre = $request->has('membre');
        $user->prvlg_project = $request->has('project');
        $user->prvlg_partenaire = $request->has('partenaire');
        $user->prvlg_create_blog = $request->has('create-blog');
        $user->prvlg_delete_blog = $request->has('del-blog');
        $user->prvlg_update_blog = $request->has('updat-blog');
        $user->prvlg_approv_blog = $request->has('approb-blog');
  
        $user->save();

        return redirect()->route('utilisateur.index')->with('success', 'Utilisateur modifier avec succes');
    }



  /*   public function show($id) {
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

 */
}
