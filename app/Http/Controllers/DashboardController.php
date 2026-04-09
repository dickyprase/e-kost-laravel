<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $rooms = Room::with('category')->where('status', 'ready')->get();
        $categories = Category::all();

        return view('dashboard', compact('rooms', 'categories'));
    }

    public function aboutus()
    {
        return view('about');
    }
}
