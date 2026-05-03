<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(){
        $bookings = Booking::with('customer')->latest()->get();
        $buildings = Building::with('rooms.building')->get();
        return view('booking',compact('bookings','buildings'));
    }
    public function store(Request $request)
{
    Booking::create([
        'customer_id' => Auth::user()->id,
        'room_id' => $request->room_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'amount' => $request->amount,
        'status' => $request->status ?? 'pending',
    ]);
    $room = Room::find($request->room_id);

    if ($room) {
        $room->update([
            'status' => 'booked'
        ]);
    }

    return back();
}

public function update(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    $booking->update([
        'status' => $request->status,
    ]);

    return back();
}
}
