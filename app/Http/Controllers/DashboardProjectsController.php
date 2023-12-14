<?php

namespace App\Http\Controllers;

use App\Models\Prioritas;
use App\Models\Progress;
use App\Models\Projects;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('admin') || $user->hasRole('adminsuper')) {
            // Pengguna adalah admin atau super admin, tampilkan semua data
            $projects = Projects::all();
        } else {
            // Pengguna adalah user, tampilkan data sesuai dengan pengguna
            $projects = $user->projects()->with('users')->get();
        }
        
        return view('projects.projects.index', compact('projects', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendor = Vendor::all();
        $prioritas = Prioritas::all();
        $progress = Progress::all();
        return view('projects.projects.projectscreate', compact('vendor', 'prioritas', 'progress'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $projects = Projects::create([
            'nama_project' => $request->nama_project,
            'detail_project' => $request->detail_project,
            'vendor_id' => $request->vendor_id,
            'platform' => $request->platform,
            'prioritas_id' => $request->prioritas_id,
            'pic' => $request->pic,
            'target' => $request->target,
            'status_progress_id'=> $request->status_progress_id
        ]);

        $projects->id_owner = Auth::id();
        
        $projects->save();

        $vendorId = $request->input('vendor_id');
        
        auth()->user()->projects()->attach($projects);

        $projects->vendor()->attach($vendorId);
        
        return redirect(route('projects.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $projects = Projects::with(['users' => function ($query) {
        $query->orderBy('user_projects.created_at', 'asc');
    }])->findOrFail($id);

    $latestStatus = $projects->status()->latest()->first();
    
    $isProjectOwner = $projects->users->first()->id === auth()->user()->id;

    return view('projects.projects.showprojects', compact('projects', 'latestStatus', 'isProjectOwner'));
}

public function search(Request $request){
    if($request->has('search')){
        $projects = Projects::where('nama_project', 'LIKE', '%'.$request->search.'%')->get();
    }
    else{
        $projects = Projects::all();
    }
    return view('projects.projects.index', ['projects'=> $projects]);
}

public function export()
{
    $user = Auth::user();
    $latestProject = $user->projects()->with('status')->latest()->first();
    $projects = $user->projects()->with('users')->get();
    if ($user->hasRole('admin') || $user->hasRole('adminsuper')) {
        // Pengguna adalah admin atau super admin, tampilkan semua data
        $projects = Projects::all();
    } else {
        // Pengguna adalah user, tampilkan data sesuai dengan pengguna
        $projects = $user->projects()->with('users')->get();
    }
    if (!$latestProject) {
        // Jika tidak ada proyek yang ditemukan, arahkan ke halaman pembuatan proyek
        if ($user->hasRole('admin') || $user->hasRole('adminsuper')) {
            // Pengguna adalah admin atau super admin, tampilkan semua data
            $projects = Projects::all();
            return view('projects.projects.projectsexport', compact('latestProject', 'projects'));
        } else {
            // Pengguna adalah user, tampilkan data sesuai dengan pengguna
            return redirect()->route('projects.create');
        }
    }

    return view('projects.projects.projectsexport', compact('latestProject', 'projects'));
}

public function export_show($id){
    $projects = Projects::with(['users' => function ($query) {
        $query->orderBy('user_projects.created_at', 'asc');
    }])->findOrFail($id);

    $latestStatus = $projects->status()->latest()->first();
    
    $isProjectOwner = $projects->users->first()->id === auth()->user()->id;

    return view('projects.projects.showprojectsexport', compact('projects', 'latestStatus', 'isProjectOwner'));
}

public function NewProjects(){
    $user = Auth::user();
    $projects = $user->projects()
    ->whereHas('progress', function ($query) {
        $query->where('status_progress', 'New');
    })
    ->get();

    return view('projects.projects.index', compact('projects','user'));
}


public function ProgressProjects(){
    $user = Auth::user();
    $projects = $user->projects()
    ->whereHas('progress', function ($query) {
        $query->where('status_progress', 'Progress');
    })
    ->get();

    return view('projects.projects.index', compact('projects','user'));
}

public function CompletedProjects(){
    $user = Auth::user();
    $projects = $user->projects()
    ->whereHas('progress', function ($query) {
        $query->where('status_progress', 'Completed');
    })
    ->get();

    return view('projects.projects.index', compact('projects','user'));
}

public function HighProjects(){
    $user = Auth::user();
    $projects = $user->projects()
    ->whereHas('prioritas', function ($query) {
        $query->where('prioritas', 'High');
    })
    ->get();

    return view('projects.projects.index', compact('projects','user'));
}

public function MediumProjects(){
    $user = Auth::user();
    $projects = $user->projects()
    ->whereHas('prioritas', function ($query) {
        $query->where('prioritas', 'Medium');
    })
    ->get();

    return view('projects.projects.index', compact('projects','user'));
}

public function LowProjects(){
    $user = Auth::user();
    $projects = $user->projects()
    ->whereHas('prioritas', function ($query) {
        $query->where('prioritas', 'Low');
    })
    ->get();

    return view('projects.projects.index', compact('projects','user'));
}

public function PendingProjects(){
    $user = Auth::user();
    $projects = $user->projects()
    ->whereHas('prioritas', function ($query) {
        $query->where('prioritas', 'Pending');
    })
    ->get();

    return view('projects.projects.index', compact('projects','user'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendor = Vendor::all();
        $prioritas = Prioritas::all();
        $projects = Projects::findOrFail($id);
        return view('projects.projects.projectsedit', compact('projects', 'vendor', 'prioritas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $projects = Projects::findOrFail($id);
       $projects->update([
            'nama_project' => $request->nama_project,
            'detail_project' => $request->detail_project,
            'vendor_id' => $request->vendor_id,
            'platform' => $request->platform,
            'prioritas_id' => $request->prioritas_id,
            'pic' => $request->pic,
            'target' => $request->target
       ]);

       $vendors = $request->input('vendor_id',[]);

       $projects->vendor()->sync($vendors);

       return redirect(route('projects.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Projects::findOrFail($id);
        
        $project->status()->delete();

        $project->delete();
        
        return redirect()->route('projects.index');
    }
}
