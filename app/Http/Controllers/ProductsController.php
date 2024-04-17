<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;


class ProductsController extends Controller
{
    public function index()
    {

        $blogs = DB::table('blogs')->paginate(5);
        return view('product/blog', [
            'blogs' => $blogs,
        ]);
    }
    function main()
    {

        $main = DB::table('blogs')->paginate(8);
        return view('welcome', ['main' => $main

    ]);

    }
    function create()
    {
        return view('product/form');
    }


    function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
            'category' => 'required|max:50',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate the image file
            'price' => 'numeric', // Validate the price field as numeric

        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'image' => $request->image,
            'category' => $request->category
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = null;
        }

        Blog::create($data);

        return redirect('/blog');
    }


    function delete($id)
    { // ทำไมไม่ใช้ eloquant
        DB::table('blogs')->where('id', $id)->delete();
        return redirect('/blog');
    }
    function change($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        $data = [
            'status' => !$blog->status
        ];
        $blog = DB::table('blogs')->where('id', $id)->update($data);
        return redirect('/blog');
    }
    function edit($id)
    {
        $blog = DB::table('blogs')->where('id', $id)->first();
        return view('product/edit', compact('blog'));
    }
    function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required',
                'price' => 'required',
                'category' => 'required',
            ],
            [
                'title.required' => 'กรุณากรอกชื่อบทความ',
                'title.max' => 'กรุณากรอกชื่อบทความไม่เกิน 50 ตัวอักษร',
                'content.required' => 'กรุณากรอกเนื้อหาบทความ',
                'price.required' => 'กรุณากรอกราคาสินค้า   ',
                'category.required' => 'กรุณากรอกหมวดหมู่สินค้า   ',
            ]
        );
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
            'image' => $request->image,
            'category' => $request->category
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = null;
        }
        DB::table('blogs')->where('id', $id)->update($data);
        return redirect('/blog');
    }
}
