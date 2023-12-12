<?php
namespace App\Http\Controllers;
use App\Models\publication;
use App\Models\User;
use App\Http\Controllers\ViewsCounterController;
use App\Models\ImpactValue;
use App\Models\Project;
use App\Models\Tache;
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
        $users = User::all();

        $tache = Tache::select('taches.*')
            ->where('taches.status_task','En attente')
            ->orWhere('taches.status_task','En revision')
            ->orderBy('taches.created_at', 'desc')
            ->get();



        $countProjdone = Project::selectRaw('(COUNT(objectifs.id) * 100 / (SELECT COUNT(*) FROM objectifs WHERE objectifs.project_id = projects.id)) as percentage')
            ->join('objectifs', 'projects.id', '=', 'objectifs.project_id')
            ->where('objectifs.status_obj', 'done')
            ->groupBy('projects.id')
            ->havingRaw('percentage = 100')
            ->count();
            $countProjwait = Project::selectRaw('(COUNT(objectifs.id) * 100 / (SELECT COUNT(*) FROM objectifs WHERE objectifs.project_id = projects.id)) as percentage')
            ->join('objectifs', 'projects.id', '=', 'objectifs.project_id')
            ->where('objectifs.status_obj', '!=','done')
            ->groupBy('projects.id')
            ->havingRaw('percentage != 100')
            ->count();

        $impactValues = ImpactValue::first();
        $totalGeneral = $impactValues->enfants + $impactValues->adolescents + $impactValues->adultes;

        return view('dashboard.index', compact('tache', 'users','countProjdone','countProjwait','impactValues','totalGeneral'));
    }

}
