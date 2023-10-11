<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{

    public function index(Request $request)
    {
        return view('archive.index');
    }
}
