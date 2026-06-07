<?php

namespace App\Http\Controllers;

use App\Models\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        if(Auth::user()->role=="landload"){
        $users = SystemUser::latest()->where('role','=','customer')->get();
        }elseif(Auth::user()->role=="admin"){
        $users = SystemUser::latest()->where('role','!=','admin')->get();}
        return view("registration",compact('users'));
    }
      public function store(Request $request)
    {
        $request->validate([
    'firstname' => 'required',
    'middlename' => 'required',
    'lastname' => 'required',
    'email' => 'required|email',
    'phone' => 'required',
    'password' => 'required|min:6|confirmed',
],[
    'firstname.required' => 'Please enter your first name.',
    'middlename.required' => 'Please enter your middle name.',
    'lastname.required' => 'Please enter your last name.',
    'email.required' => 'Please enter your email address.',
    'email.email' => 'Please provide a valid email address.',
    'phone.required' => 'Please enter your phone number.',
    'password.required' => 'Please enter a password.',
    'password.min' => 'Your password must contain at least 6 characters.',
    'password.confirmed' => 'The password confirmation does not match.',
]);
        SystemUser::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route("showlogin")->with('success', 'Registration completed successfully,please login!');
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
