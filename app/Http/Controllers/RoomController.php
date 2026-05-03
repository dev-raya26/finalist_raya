<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::latest()->get();
        return view("rooms",compact('rooms'));
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
        'type' => $request->type,
        'status' => $request->status,
        'description' => $request->description,
        'image' => $filename
    ]);

    return back();
}
}
