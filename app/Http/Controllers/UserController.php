<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\SystemUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        if(Auth::user()->role=="landload"){
        $users = SystemUser::latest()->where('role','customer')->get();
        }elseif(Auth::user()->role=="admin"){
        $users = SystemUser::latest()->where('role','!=','admin')->get();}
        $noteCount = Notification::count();
        $notes = Notification::all();
        return view("registration",compact('users','noteCount','notes'));
    }
    public function searchUsers(Request $request)
{
    $search = $request->search;

    $query = SystemUser::query();

    if(Auth::user()->role == "landload"){
        $query->where('role', 'customer');
    }

    if(Auth::user()->role == "admin"){
        $query->where('role', '!=', 'admin');
    }

    $query->where(function($q) use ($search){
        $q->where('firstname', 'like', "%{$search}%")
          ->orWhere('middlename', 'like', "%{$search}%")
          ->orWhere('lastname', 'like', "%{$search}%")
          ->orWhere('phone', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
    });

    $users = $query->latest()->get();

    return response()->json($users);
}
      public function store(Request $request)
    {
        $request->validate([
    'firstname' => 'required',
    'middlename' => 'required',
    'lastname' => 'required',
    'email' => 'required|email|unique:system_users,email',
    'phone' => 'required',
    'password' => 'required|min:4|confirmed',
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

       if (Auth::guard('web')->check() && Auth::user()->role == 'admin') {
            return back()->with("success","User registered sucess! ");
        }

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

    public function destroy($id)
{
    $user = SystemUser::findOrFail($id);

    $user->delete();

    return redirect()->back()
        ->with('success', 'User deleted successfully');
}
    public function clearAll()
{
    Notification::truncate();

    return back();
}
}
