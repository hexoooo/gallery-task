<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller 
{
    public function index()
    {
        $albums = Gallery::all();
        return view('dashboard.site.gallery.index', compact('albums'));
    }
    public function store(Request $request)
    {
        $albums = Gallery::create(['name' => $request->album_name]);
        return redirect()->back();
    }
    public function remove(Request $request, Image $image)
    {
        // Implement logic to delete the file from the storage
        $image->delete();

        return response()->json(['success' => true]);
    }

}
