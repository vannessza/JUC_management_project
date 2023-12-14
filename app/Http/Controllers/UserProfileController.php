<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('projects.profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.profile.profilecreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'phone' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = auth()->user();
        
        $profile = new UserProfile([
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profiles');
            $imageName = basename($imagePath);
            $profile->image = $imageName;
        }

        $user->profile()->save($profile);
        
        return redirect()->route('profile.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = auth()->user();
        return view('projects.profile.profileedit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    // Validasi data yang diinputkan pengguna
    $this->validate($request, [
        'address' => 'required',
        'phone' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Menyesuaikan dengan jenis gambar yang diizinkan
    ]);
    
    $user = auth()->user();
    $profile = $user->profile;
    
    $profile->address = $request->address;
    $profile->phone = $request->phone;
    
    // Jika ada gambar yang diupload, simpan gambar baru
    if ($request->hasFile('image')) {
        if ($request->oldImage) {
            Storage::delete('profiles/' . $request->oldImage);
        }
        
        $imagePath = $request->file('image')->store('profiles');
        $imageName = basename($imagePath);
        $profile->image = $imageName;
    }
    
    $profile->save();
    
    return redirect()->route('profile.index');
}
public function showChangePasswordForm()
{
    return view('projects.profile.changepassword');
}

public function changePassword(Request $request)
{
    $user = auth()->user();

    $this->validate($request, [
        'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
            if (!Hash::check($value, $user->password)) {
                $fail('The current password is incorrect.');
            }
        }],
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('profile.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
