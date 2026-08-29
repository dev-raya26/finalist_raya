<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Building;
use App\Models\Notification;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
{
    if (Auth::user()->role == "customer") {

        $bookings = Booking::with('customer')
            ->where("customer_id", Auth::user()->id)
            ->latest()
            ->get();

    } else {

        $bookings = Booking::with('customer')
            ->latest()
            ->get();
    }

    $buildings = Building::with([
        'rooms' => function ($query) {
            $query->where('status', 'available');
        }
    ])
    ->whereHas('rooms', function ($query) {
        $query->where('status', 'available');
    })
    ->get();

    $selectedRoom = null;

    if (session()->has('selected_room')) {
        $selectedRoom = Room::with('building')
            ->find(session('selected_room'));
    }

    $noteCount = Notification::count();
    $notes = Notification::all();

    return view(
        'booking',
        compact(
            'bookings',
            'buildings',
            'notes',
            'noteCount',
            'selectedRoom'
        )
    );
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
    session()->forget('selected_room');
    $room = Room::find($request->room_id);

    if ($room) {
        $room->update([
            'status' => 'booked'
        ]);
    }
    Notification::create([
        "title" => "Booking alert",
        "action" => "The Ternant ".Auth::user()->firstname." ".Auth::user()->middlename." has made booking",
    ]);

    return back()->with("success","Booking submitted successful,You will receive email within 24 hours!");
}

public function update(Request $request, $id)
{
    $booking = Booking::findOrFail($id);

    $booking->update([
        'status' => $request->status,
    ]);


    if ($request->status == 'approved') {

    // Generate control number
    $controlNumber = '0772703994';

    // Save control number
    $booking->control_number = $controlNumber;
    $booking->save();

    $email = $booking->customer->email;

    Mail::send([], [], function ($message) use ($booking, $email, $controlNumber) {

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
                    <strong>Use this Mobile Number to Pay:</strong>
                    {$controlNumber}
                    <strong>Name: RAYA MOHAMED</strong>


                </p>

                <p>
                    Please make payment using the above Mobile number to start living in the house.
                </p>

                <p>Thank you.</p>
            ");
    });
}

    return back()->with('success', 'Booking status updated successfully.');
}


        public function tenantProfile()
{
    $booking = Booking::with([
    'customer',
    'room.building',
    'payment'
])
->where('customer_id', Auth::id())
->firstOrFail();

    $totalPaid = $booking->payment()
        ->where('status','paid')
        ->sum('amount');

    $paidMonths = $booking->payment()
        ->where('status','paid')
        ->count();

    return view(
        'tenantprofile',
        compact(
            'booking',
            'totalPaid',
            'paidMonths'
        )
    );
}
}
