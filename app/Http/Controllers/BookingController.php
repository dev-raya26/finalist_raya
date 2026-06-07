<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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


    if ($request->status == 'approved') {

        $email = $booking->customer->email; 

        Mail::send([], [], function ($message) use ($booking, $email) {

            $message->to($email)
                ->subject('House Booking Confirmation')
                ->html("
                    <h2>House Booking Confirmation</h2>

                    <p>Dear {$booking->customer->firstname} {$booking->customer->middlename} {$booking->customer->lastname},</p>

                    <p>Your house booking has been confirmed.</p>

                    <p>
                        <strong>Starting Date:</strong>
                        {$booking->start_date}
                    </p>

                    <p>
                        <strong>End Date:</strong>
                        {$booking->end_date}
                    </p>

                    <p>
                        Please make payment to start living in the house.
                    </p>

                    <p>Thank you.</p>
                ");
        });
    }

    return back()->with('success', 'Booking status updated successfully.');
}
}
