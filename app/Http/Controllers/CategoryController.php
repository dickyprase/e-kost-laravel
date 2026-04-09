<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Mengambil kategori yang memiliki kamar dengan status 'ready'
        $categories = Category::whereHas('rooms', function ($query) {
            $query->where('status', 'ready');
        })->get();

        return view('layouts.navigation', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        // Ambil data kamar yang terkait kategori ini, kalau ada
        return view('kategori.show', compact('category'));
    }
}
