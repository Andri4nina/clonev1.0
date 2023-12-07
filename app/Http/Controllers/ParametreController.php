<?php

namespace App\Http\Controllers;

use App\Models\Historique;
use App\Models\User;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index(Request $request)
    {
        return view('parametre.index');
    }

    public function modifSelf(Request $request, User $user){
     
        $request->validate([
            'user-name'=>'required',
            'user-mdp'=>'required'
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
        $user->password = bcrypt($request->input('user-mdp'));
        $historique =   $user->name  . " a modifier son profil ";
      
        $histo = new Historique();
        $histo->descri_histo = $historique;
        $histo->save();

          return redirect()->back()->with('success', ' Modification effectuer!');
    }
}
