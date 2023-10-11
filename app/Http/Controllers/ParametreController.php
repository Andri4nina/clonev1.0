<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index(Request $request)
    {
        return view('parametre.index');
    }
}
