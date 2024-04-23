<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category.index');
    }

    // Corrected main method
    public function main()
    {
        $main = DB::table('blogs')->paginate(8);
        return view('category.index', ['main' => $main]); // Close the array properly
    }
}
