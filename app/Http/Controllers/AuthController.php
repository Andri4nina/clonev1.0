<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function login()
    {
        return view('auth.login'); 
    }   
    // Processus de connexion
    public function doLogin(LoginRequest $request)
    {
        $authCredentials = $request->validated();
       /*  dd($request->all()); */
    
        if (Auth::attempt($authCredentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
            $user->status_user = 'en ligne';
            $user->save();
    
            return redirect()->route("dashboard.index");
        }
    
        return redirect()->route('auth.login')->withErrors([
            'user-email' => 'Invalide',
        ]);
    }
    



   // Gère le processus de déconnexion
   public function logout(Request $request): RedirectResponse
   {   
       // Récupère l'utilisateur connecté
       $user = Auth::user();
       // Met à jour le statut de l'utilisateur à "hors-ligne" et enregistre la date de déconnexion
       $user->status_user = 'hors-ligne';
       $user->save(); // Enregistre les modifications
       // Déconnecte l'utilisateur et nettoie la session
       Auth::logout();
       Session::flush();
       $request->session()->invalidate();
       $request->session()->regenerateToken();      
       // Redirige vers la page de connexion
       return redirect()->route('auth.login'); 
   }
}