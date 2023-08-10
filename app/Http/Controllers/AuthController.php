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
    public function login()
    {
        return view('auth.login'); 
    }

       public function doLogin(LoginRequest $request)
    {
        $authCredentials = $request->validated();
    
        if (Auth::attempt($authCredentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $user->status_user = 'en ligne';
            $user->save();
            return redirect()->route("dashboard.index");
        }
    
        return redirect()->route('auth.login')->withErrors([
            'email' => 'Invalide',
        ]);
    }




    public function logout(Request $request): RedirectResponse
    {   
        $user = Auth::user();
        $user->status_user = 'hors-ligne';
        $user->date_deconnexion_user = date('Y-m-d H:i:s'); 
        $user->save();
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
        return to_route('auth.login'); 
    }


 
}

