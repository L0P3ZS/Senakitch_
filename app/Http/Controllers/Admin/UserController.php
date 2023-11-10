<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.store')->only('store');
        $this->middleware('can:admin.users.update')->only('update');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }
    public function index()
    {
        $users = User::with('roles:name')->get();
        return view('admin.cruds.users',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'profile_photo_path' => 'image|max:2048',
        ]);
        
        $image = $request->file('profile_photo_path');
        $fileName = $image->getClientOriginalName();
        $filePath = $image->store('profile-photos', 'public');
        
        $data = $request->only('name', 'email');
        $data['password'] = Hash::make($request->password);
        $data['profile_photo_path'] = $filePath;
        
        User::create($data);
        
        return redirect()->route('admin.users.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
