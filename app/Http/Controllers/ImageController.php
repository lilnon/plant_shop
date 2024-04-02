<?php

// app/Http/Controllers/ImageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Show the form for uploading an image.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Handle the uploaded image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        // Validate the request data
        $request->validate([
            'image' => 'required|image|max:2048', // Maximum file size of 2MB
        ]);

        // Store the uploaded image in storage
        $imagePath = $request->file('image')->store('uploads');

        // You may want to store the image path in the database
        // For example:
        // auth()->user()->update(['image_path' => $imagePath]);

        // Return a response or redirect as needed
        return back()->with('success', 'Image uploaded successfully!');
    }
}

