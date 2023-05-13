<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function show($slug) {
        $image = Image::where('slug', $slug)->first();
        if (!$image) {
            return redirect('/');
        }
        return view('show', compact('image'));
    }
    public function index() {
        return view('show');
    }
}
