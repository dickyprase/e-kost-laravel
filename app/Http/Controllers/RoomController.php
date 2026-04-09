<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = Room::with('category')->findOrFail($id);
        return view('rooms.show', compact('room'));
    }
}
