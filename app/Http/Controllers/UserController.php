<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = SystemUser::latest()->where('role','landload')->get();
        return view("registration",compact('users'));
    }
      public function store(Request $request)
    {
        // validation
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role' => 'required',
        ]);

        // save user
        SystemUser::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'User registered successfully');
    }
    public function update(Request $request, $id)
{
    $user = SystemUser::findOrFail($id);

    $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $user->update([
        'firstname' => $request->firstname,
        'middlename' => $request->middlename,
        'lastname' => $request->lastname,
        'phone' => $request->phone,
        'email' => $request->email,
    ]);

    return back()->with('success', 'User updated successfully');
}
}
