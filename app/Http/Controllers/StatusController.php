<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $projects = Projects::findOrFail($id);

        $latestStatus = $projects->status()->latest()->first();

        $team = $projects->users;

        return view('projects.projects.status.index', compact('projects', 'latestStatus', 'team'));
    }

    public function history($id){
        $projects = Projects::findOrFail($id);

        $history = $projects->status()->latest()->get();

        $team = $projects->users;

        return view('projects.projects.status.history', compact('projects', 'history', 'team'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $projects = Projects::findOrFail('id');
        return view('projects.projects.status.statuscreate', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Status = Status::create([
            'Tanggal' => $request->tanggal,
            'update' => $request->update,
            'comment' => $request->comment,
            'project_id'=> $request->project_id
        ]);
        
        return redirect()->route('status.index', $Status->project_id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($project_id, $id)
    {
        $projects = Projects::findOrFail($project_id);
        $status = Status::findOrFail($id);
        return view('projects.projects.status.statusedit', compact('status', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $project_id, $id)
    {
       $status = Status::findOrFail($id);
       $status->update([
        'Tanggal' => $request->Tanggal,
        'update' => $request->update,
        'comment' => $request->comment
       ]);
       return redirect(route('projects.index', ['project'=>$project_id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($project_id, $id)
    {
        $project = Status::findOrFail($id);

        $project->delete();
        
        return redirect()->route('projects.index', ['project'=>$project_id]);
    }
}
