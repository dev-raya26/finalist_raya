<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Notification;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::latest()->get();
        $buildings = Building::where('landlord_id',Auth::user()->id)->get();
        $noteCount = Notification::count();
        $notes = Notification::all();
        return view("rooms",compact('rooms','buildings','notes','noteCount'));
    }
        public function show($id)
    {
        $room = Room::findOrFail($id);

        return view('room_view', compact('room'));
    }
    public function store(Request $request)
{
    $filename = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
    }

    Room::create([
        'building_id' => $request->building_id,
        'room_number' => $request->room_number,
        'price' => $request->price,
        'room_area' => $request->room_size,
        'type' => $request->type,
        'status' => $request->status,
        'description' => $request->description,
        'image' => $filename
    ]);

    return back();
}
}
