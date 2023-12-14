<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddController extends Controller
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
        $availableUsers = User::whereNotIn('id', $projects->users->pluck('id'))->get();

        return view('projects.projects.adduser.adduser', compact('projects', 'availableUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Projects $projects)
    {

        $user = User::find($request->input('user_id'));

        $projects->users()->attach($user, ['created_at' => now()]);

        return redirect(route('projects.show', $projects->id));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
{
    $profile = $user->profile;
    
    return view('projects.projects.adduser.showuser', compact('profile'));
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
    public function removeUser(Projects $projects, User $user)
{
     // Periksa apakah pengguna saat ini adalah pemilik proyek
     if (Auth::id() !== $projects->id_owner) {
        return redirect()->route('projects.show', $projects->id)
            ->with('error', 'Anda tidak memiliki izin untuk menghapus anggota.');
    }

    // Hapus anggota tim
    $projects->users()->detach($user->id);

    return redirect()->route('projects.show', $projects->id)
        ->with('success', 'Anggota tim berhasil dihapus.');
}

public function leaveUser(Projects $projects)
{
    $user = auth()->user(); // Dapatkan pengguna saat ini

    // Periksa apakah pengguna saat ini adalah pemilik proyek
    if ($user->id === $projects->id_owner) {
        // Jika pemilik proyek ingin meninggalkan, cari anggota tim lainnya
        $otherMembers = $projects->users()->where('id', '!=', $user->id)->get();

        // Pilih anggota tim pertama sebagai pemilik baru (atau logika lainnya)
        $newOwner = $otherMembers->first();

        if ($newOwner) {
            // Atur pemilik baru
            $projects->id_owner = $newOwner->id;
            $projects->save();
        } else {
            // Tidak ada anggota tim lainnya, proyek menjadi tanpa pemilik
            $projects->delete();
            return redirect(route('projects.index'));
        }
    }

    // Hapus pengguna dari proyek
    $projects->users()->detach($user->id);

    return redirect(route('projects.index'));
}
}
