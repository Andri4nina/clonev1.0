<?php
namespace App\Http\Controllers;
use App\Models\publication;
use App\Models\User;
use App\Http\Controllers\ViewsCounterController;
use Illuminate\Http\Request;

class DashController extends Controller
{
    protected $viewsCounterController;

    public function __construct(ViewsCounterController $viewsCounterController)
    {
        $this->viewsCounterController = $viewsCounterController;
    }

    public function index(Request $request)
    {

    
        return view('dashboard.index');
    }
}