<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Notification;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
     public function index()
    {
        $noteCount = Notification::count();
        $notes = Notification::all();
        $rooms = Building::latest()->get();
        return view('building', compact('rooms','noteCount','notes'));
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
    public function show($id)
{
    $building = Building::findOrFail($id);

    $rooms = Room::where('building_id', $id)->get();
     $noteCount = Notification::count();
        $notes = Notification::all();
    return view('buildings_show', compact('building', 'rooms','noteCount','notes'));
}
public function toggleStatus($id)
{
    $building = Building::findOrFail($id);

    if ($building->status == 'Active') {
        $building->status = 'Blocked';
    } else {
        $building->status = 'Active';
    }

    $building->save();

    return back()->with('success', 'Status updated successfully');
}

  
}
