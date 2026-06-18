<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Notification;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function index()
{
    $noteCount = Notification::count();
    $notes = Notification::all();
    if(Auth::user()->role=="customer"){

    $payments = Payment::whereHas('booking', function ($query) {
    $query->where('customer_id', Auth::user()->id);
})->get();
        }else{
            $payments = Payment::all();

        }

    $booking = Booking::with('room')
        ->where('customer_id', Auth::user()->id)
        ->where('status', 'approved')
        ->first();

    return view('payment', compact(
        'payments',
        'booking',
        'noteCount',
        'notes'
    ));
}
    public function store(Request $request)
{
    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'payment_month' => 'required',
        'payment_year' => 'required',
        'amount' => 'required'
    ]);

    $exists = Payment::where('booking_id', $request->booking_id)
        ->where('payment_month', $request->payment_month)
        ->where('payment_year', $request->payment_year)
        ->first();

    if ($exists) {
        return back()->with(
            'error',
            'This month has already been paid.'
        );
    }

    Payment::create([
        'booking_id' => $request->booking_id,
        'amount' => $request->amount,
        'payment_month' => $request->payment_month,
        'payment_year' => $request->payment_year,
        'status' => 'pending'
    ]);

    return back()->with(
        'success',
        'Payment submitted successfully.'
    );
    
}

       public function verify($id)
{
    $payment = Payment::with('booking.customer')
        ->findOrFail($id);

    if ($payment->status == 'paid') {
        return back()->with('error', 'Payment already verified.');
    }

    $booking = $payment->booking;

    // Punguza deni
    $booking->amount = max(0, $booking->amount - $payment->amount);

    $booking->save();

    // Verify payment
    $payment->update([
        'status' => 'paid',
        'paid_at' => now()
    ]);

    // Tuma receipt email
    $customer = $booking->customer;

    Mail::send([], [], function ($message) use ($customer, $payment, $booking) {

        $message->to($customer->email)
            ->subject('Payment Receipt')
            ->html("
                <h2>Payment Receipt</h2>

                <p>Dear {$customer->firstname} {$customer->lastname}</p>

                <p>Your payment has been verified.</p>

                <p><strong>Amount Paid:</strong> TZS ".number_format($payment->amount,2)."</p>

                <p><strong>Remaining Balance:</strong> TZS ".number_format($booking->amount,2)."</p>

                <p><strong>Control Number:</strong> {$booking->control_number}</p>
            ");
    });

    return back()->with(
        'success',
        'Payment verified successfully.'
    );
}
}
