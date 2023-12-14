<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AddadminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $admin = User::where('role', 'admin')->get();
    
    return view('projects.admin.index', compact('admin'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.admin.admincreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|min:1|max:25',
        'username' => ['required', 'min:3', 'max:255', 'unique:users'],
        'email' => 'required|email:dns|unique:users',
        'password' => 'required|min:6|max:255'
    ],[
        'name.required'=>'Nama Required',
        'username.required'=>'Username Required',
        'email.required'=>'Email Required',
        'password.required'=>'Password Required',
    ]);

    // Tambahkan peran 'admin' ke data yang akan disimpan
    $validatedData['role'] = 'admin';

    $validatedData['password'] = Hash::make($validatedData['password']);
    $user = User::create($validatedData);

    UserProfile::create([
        'user_id' => $user->id,
        'address' => 'Default Address',
        'phone'=> '08xxxxxxxx'
    ]);

    return redirect(route('admin.index'))->with('success', 'Registration successfull! Please login')->withErrors($validatedData)->withInput();
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
    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('projects.admin.adminedit',compact("admin"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = User::findOrFail($id);
        $admin->update([
            'name'=> $request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
       ]);

       return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);

        $admin->delete();
        
        return redirect()->route('admin.index');
    }
}
