<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $blogs = Blog::all(); // Fetch all blog entries
        return view('welcome', ['blogs' => $blogs]);

    }

    function main2()
    {

        $main = DB::table('blogs')->paginate(8);
        return view('welcome', ['main' => $main

    ]);
    }
}
