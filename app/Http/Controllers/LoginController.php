<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Building;
use App\Models\Notification;
use App\Models\Room;
use App\Models\SystemUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    public function showlogin(){
        return view("login");
    }
    public function signup(){
        return view("signup");
    }
    public function home(){
    $buildings = Building::with([
        'rooms',
        'landlord'
    ])->get();
    
    $rooms = Room::with('building.landlord')->where('status','!=','booked')->get();
    return view("welcome", compact('rooms','buildings'));
}
    public function dashboard(){
        $totalLandlords = SystemUser::where('role', 'landload')->count();
        $totalCustomers = SystemUser::where('role', 'customer')->count();
        $totalHouses = Building::count();
        $totalBookings = Booking::where('status','pending')->count();
        if(Auth::user()->role=="landload"){
        $last_users = SystemUser::latest()->where('role','customer')->get();
        }elseif(Auth::user()->role=="admin"){
        $last_users = SystemUser::latest()->where('role','!=','admin')->get();}
        else{
        $last_users = SystemUser::latest()->where('role','customer')->get();


        }
        $bookings = DB::table('bookings')
        ->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where('status','approved')
        ->where('created_at', '>=', Carbon::now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();
    $dates = [];
    $totals = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i)->format('Y-m-d');

        $dates[] = $date;

        $found = $bookings->firstWhere('date', $date);

        $totals[] = $found ? $found->total : 0;
    }
        $noteCount = Notification::count();
        $notes = Notification::all();
        // --- SEHEMU YA KUCHUJA DATA ZA CUSTOMER (WEKA HAPA) ---
    $user = Auth::user();
    $customerActiveBookingsCount = 0;
    $customerPendingBookingsCount = 0;
    $myActiveRooms = [];

    if ($user->role == 'customer') {
        $customerActiveBookingsCount = Booking::where('customer_id', $user->id)
            ->where('status', 'approved')
            ->count();
        $customerPendingBookingsCount = Booking::where('customer_id', $user->id)
            ->where('status', 'pending')
            ->count();
        $myActiveRooms = Booking::with('room.building')
            ->where('customer_id', $user->id)
            ->latest()
            ->get();
    }
        return view("dashboard",compact('customerActiveBookingsCount','myActiveRooms','notes','noteCount','totalLandlords','totalHouses','totalCustomers','totalBookings','last_users','dates','totals'));
    }
     public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    $user = SystemUser::where('email', $request->email)->first();

    if (!$user || $user->status !== 'active') {
        return back()->with('error', 'Account not active or not found');
    }

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        // Kama alikuwa amechagua room
        if (
            Auth::user()->role == 'customer' &&
            session()->has('selected_room')
        ) {
            return redirect()->route('bookings.index');
        }

        if (Auth::user()->role == 'admin') {
            return redirect()->route('dashboard');
        }

        if (Auth::user()->role == 'landlord') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Invalid email or password');
}
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/showlogin');
    }
    public function forgot(){
        return view("forgotpassword");
    }
    public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $status = Password::broker('users')->sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', 'Link sent successfully, check your email Inbox')
        : back()->withErrors(['email' => 'Email not found.']);
}

    public function showResetForm(Request $request, $token = null)
    {
        return view('resetpassword1', [
            'token' => $token,
            'email' => $request->query('email') 
        ]);
    }
    public function updatePassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:4|confirmed'
    ]);

    $status = Password::broker('users')->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($teacher, $password) {
            $teacher->password = Hash::make($password);
            $teacher->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('showlogin')->with('success', 'Password changed success!')
        : back()->withErrors(['email' => __($status)]);
}
}
