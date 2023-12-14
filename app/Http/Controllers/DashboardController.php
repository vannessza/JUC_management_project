<?php

namespace App\Http\Controllers;

use App\Models\Prioritas;
use App\Models\Progress;
use App\Models\Projects;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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

            $projectCount = $projects->count();
        
        $vendor = Vendor::all();
        
        $vendorCount = $vendor->count();

        $highPrioritas = Prioritas::where('prioritas', 'High')->first();

        $mediumPrioritas = Prioritas::where('prioritas', 'Medium')->first();

        $lowPrioritas = Prioritas::where('prioritas', 'Low')->first();

        $pendingPrioritas = Prioritas::where('prioritas', 'Pending')->first();

        if ($highPrioritas) {
            $numberHighPrioritas = $highPrioritas->projects->count();
        } else {
            $numberHighPrioritas = 0;
        }

        if ($mediumPrioritas) {
            $numberMediumPrioritas = $mediumPrioritas->projects->count();
        } else {
            $numberMediumPrioritas = 0;
        }

        if ($lowPrioritas) {
            $numberLowPrioritas = $lowPrioritas->projects->count();
        } else {
            $numberLowPrioritas = 0;
        }

        if ($pendingPrioritas) {
            $numberPendingPrioritas = $pendingPrioritas->projects->count();
        } else {
            $numberPendingPrioritas = 0;
        }

        $new = Progress::where('status_progress', 'New')->first();

        $progress = Progress::where('status_progress', 'Progress')->first();

        $completed = Progress::where('status_progress', 'Completed')->first();

        if ($new) {
            $numberNew = $new->projects->count();
        } else {
            $numberNew = 0;
        }

        if ($progress) {
            $numberProgress = $progress->projects->count();
        } else {
            $numberProgress = 0;
        }

        if ($completed) {
            $numberCompleted = $completed->projects->count();
        } else {
            $numberCompleted = 0;
        }

        return view('projects.index', compact('projectCount', 'vendorCount', 'numberHighPrioritas', 'numberMediumPrioritas', 'numberLowPrioritas', 'numberPendingPrioritas', 'numberNew', 'numberProgress', 'numberCompleted', 'user', 'vendor'));

        } else {
            // Pengguna adalah user, tampilkan data sesuai dengan pengguna
            $projects = $user->projects;

            $user = Auth::user();

    // Mengambil semua proyek yang dimiliki oleh pengguna
    $projects = $user->projects;

    // Menginisialisasi variabel jumlah prioritas
    $numberHighPrioritas = 0;
    $numberMediumPrioritas = 0;
    $numberLowPrioritas = 0;
    $numberPendingPrioritas = 0;

    $numberNew = 0;
    $numberProgress = 0;
    $numberCompleted = 0;

    // Menghitung jumlah prioritas berdasarkan proyek yang dimiliki oleh pengguna
    foreach ($projects as $project) {
        $prioritas = $project->prioritas;
    
        if ($prioritas) {
            switch ($prioritas->prioritas) {
                case 'High':
                    $numberHighPrioritas++;
                    break; // Add a break statement here
                case 'Medium':
                    $numberMediumPrioritas++;
                    break; // Add a break statement here
                case 'Low':
                    $numberLowPrioritas++;
                    break; // Add a break statement here
                case 'Pending':
                    $numberPendingPrioritas++;
                    break; // Add a break statement here
                default:
                    break;
            }
        }
    
        $progress_status = $project->progress;
    
        if ($progress_status) {
            switch ($progress_status->status_progress) {
                case 'New':
                    $numberNew++;
                    break; // Add a break statement here
                case 'Progress':
                    $numberProgress++;
                    break; // Add a break statement here
                case 'Completed':
                    $numberCompleted++;
                    break; // Add a break statement here
                default:
                    break;
            }
        }
    }
    

    $projectCount = $projects->count();
    $vendorCount = Vendor::count();

    return view('projects.index', compact('projectCount', 'vendorCount', 'numberHighPrioritas', 'numberMediumPrioritas', 'numberLowPrioritas', 'numberPendingPrioritas', 'numberNew', 'numberProgress', 'numberCompleted', 'user'));
        }

        
    }

    /**
     * Show the form for creating a new resource.
     */

    public function vendorview(){
        $vendor = Vendor::all();
        return view('projects.vendorview', compact('vendor'));
    }

    public function search(Request $request){
        if($request->has('search')){
            $vendor = Vendor::where('nama_perusahaan', 'LIKE', '%'.$request->search.'%')->get();

        }
        else{
            $vendor = Vendor::all();
        }
        return view('projects.vendorview', ['vendor'=> $vendor]);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
