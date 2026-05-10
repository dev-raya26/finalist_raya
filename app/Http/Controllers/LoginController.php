<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Building;
use App\Models\Room;
use App\Models\SystemUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $last_users = SystemUser::where("role","landload")->take(3)->orderByDesc("created_at")->get();
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
        return view("dashboard",compact('totalLandlords','totalHouses','totalCustomers','totalBookings','last_users','dates','totals'));
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
}
