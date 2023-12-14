<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdduserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->get();
        
        return view('projects.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.user.usercreate');
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
            'role'=>'user'
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $user = User::create($validatedData);

        UserProfile::create([
            'user_id' => $user->id,
            'address' => 'Default Address',
            'phone'=> '08xxxxxxxx'
        ]);

        return redirect(route('user.index'))->with('success', 'Registration successfull! Please login')->withErrors($validatedData)->withInput();
    }
    
    public function search(Request $request){
        if($request->has('search')){
            $users = User::where('username', 'LIKE', '%'.$request->search.'%')->get();
        }
        elseif($request->has('search')){
            $users = User::where('email', 'LIKE', '%'.$request->search.'%')->get();
        }
        else{
            $users = User::all();
        }
        return view('projects.user.index', ['users'=> $users]);
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
        $users = User::findOrFail($id);
        return view('projects.user.useredit',compact("users"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::findOrFail($id);
        $users->update([
            'name'=> $request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>$request->password,
       ]);

       return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $users = User::findOrFail($id);

        $users->delete();
        
        return redirect()->route('user.index');
    }
}
