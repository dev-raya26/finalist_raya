<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
{
    $query = Payment::with(['booking.customer', 'booking.room']);

    if ($request->has('start_date') && $request->start_date != '') {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->has('end_date') && $request->end_date != '') {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $payments = $query->latest()->get();

    $booking = Booking::where('customer_id', Auth::user()->id)->where('status', 'approved')->first();

    return view('report', compact('payments', 'booking'));
}
}
