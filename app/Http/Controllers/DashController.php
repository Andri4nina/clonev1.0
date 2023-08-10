<?php
namespace App\Http\Controllers;
use App\Models\publication;
use App\Models\User;

use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index(Request $request)
    {

        $countUser=User::count();

        $perPage = 2;
        $publication = Publication::join('users', 'publications.id_user', '=', 'users.id')
            ->select('publications.*', 'users.name')
            ->orderBy('publications.created_at', 'desc')
            ->paginate($perPage);
        $countpublication = Publication::count();  
        $publishPublication = Publication::where("status_publi", "LIKE", "Publier")->count();  
        $WaitPublication = Publication::where("status_publi", "LIKE", "En attente")->count();  
    
        return view('dashboard.index', compact('countUser','publication','countpublication', 'publishPublication','WaitPublication'))->with('i', (request()->input('page', 1) - 1) * $perPage);
    }
}