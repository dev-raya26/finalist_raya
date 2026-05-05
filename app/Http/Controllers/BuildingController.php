<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
     public function index()
    {
        $rooms = Building::latest()->get();
        return view('building', compact('rooms'));
    }

    public function store(Request $request)
    {
         $request->validate([
        'room_name' => 'required',
        'location' => 'required',
        'image' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);
        if ($request->hasFile('image')) {

        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('images'), $filename);

    } else {
        $filename = null;
    }

        Building::create([
            'landlord_id' => Auth::user()->id,
            'room_name' => $request->room_name,
            'location' => $request->location,
            'description' => $request->description,
            'image' => $filename
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('rooms','public');
            $room->image = $image;
        }

        $room->update([
            'room_name' => $request->room_name,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return back();
    }
}
