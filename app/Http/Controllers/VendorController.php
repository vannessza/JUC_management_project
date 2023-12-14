<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendor = Vendor::all();
        return view('projects.vendor.index', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.vendor.vendorcreate');
    }

    /**
     * Store a newly created resource in storage.
     */public function store(Request $request)
        {
            $vendor = Vendor::create([
                'nama_perusahaan' => $request->nama_perusahaan,
                'alamat' => $request->alamat,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat_email' => $request->alamat_email,
                'nama_kontak' => $request->nama_kontak,
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('vendor');
                $imageName = basename($imagePath);
                $vendor->image = $imageName;
            }
            
            $vendor->save(); // Simpan objek $vendor ke database

            return redirect(route('vendor.index'));
        }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vendors = Vendor::findOrFail($id);
        $projects = $vendors->projects()->get();
        return view('projects.vendor.showvendor', compact('vendors', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('projects.vendor.vendoredit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Menyesuaikan dengan jenis gambar yang diizinkan
    ]);
    
    $vendor = Vendor::findOrFail($id);
    $vendorData = [
        'nama_perusahaan' => $request->nama_perusahaan,
        'alamat' => $request->alamat,
        'nomor_telepon' => $request->nomor_telepon,
        'alamat_email' => $request->alamat_email,
        'nama_kontak' => $request->nama_kontak,
    ];

    // Jika ada gambar yang diupload, simpan gambar baru
    if ($request->hasFile('image')) {
        // Menghapus gambar lama jika ada
        if ($vendor->image) {
            Storage::delete('vendor/' . $vendor->image);
        }
        
        $imagePath = $request->file('image')->store('vendor');
        $imageName = basename($imagePath);
        $vendorData['image'] = $imageName;
    }
    

    $vendor->update($vendorData);

    return redirect(route('vendor.index'));
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $Vendor = Vendor::findOrFail($id);

        $Vendor->delete();
        
        return redirect()->route('vendor.index');
    }
}
