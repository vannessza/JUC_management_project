<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorAddController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Projects $projects)
    {
        $availablevendor = Vendor::whereNotIn('id', $projects->vendor->pluck('id'))->get();

        return view('projects.projects.addvendor.addvendor', compact('projects', 'availablevendor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Projects $projects)
    {

        $vendor = Vendor::find($request->input('vendor_id'));

        $projects->vendor()->attach($vendor, ['created_at' => now()]);

        return redirect(route('projects.show', $projects->id));
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
    public function removeVendor(Projects $projects, Vendor $vendor)
    {
        $projects->vendor()->detach($vendor->id);

        return redirect()->route('projects.show', $projects->id)
        ->with('success', 'Vendor berhasil dihapus.');
    }
}
