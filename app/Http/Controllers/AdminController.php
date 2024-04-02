<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Blog;

    try {
        DB::statement('call reset_auto_increment()');
        $sucess = "successfully reset auto increment isWORKING!!!";
    } catch (\Exception $e) {
        $error = "Error: " . $e->getMessage();
    }

// การเข้าถึง db ของ laravel มีสองแบบ คือ DB แบบโง่ๆ ที่มึงธรรมทำ
// กับ eloquent https://laravel.com/docs/11.x/eloquent

// สมมุติ มึงมีหน้า blog ก็ทำ controller ของ blog ข้างในมีแค่ เกี่ยวกับblog แค่ insert update delete get
// แล้วถ้ามีหน้า user ก็ทำ controller ของ user
class AdminController extends Controller
{

    function index()
    {
        $blogs = DB::table('blogs')->paginate(5);
        return view('blog', compact('blogs'));
    }

    function about()
    {
        $name = "lilnon";
        $date = "3 มีนาคม 2557";
        return view('about', compact('name', 'date'));
    }
    function create()
    {
        return view('form');
    }


public function insert(Request $request)
{
    $request->validate([
        'title' => 'required|max:50',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
    ]);

    $data = [
        'title' => $request->title,
        'content' => $request->content,
    ];

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName); // Move the uploaded image to the 'images' folder in the public directory
        $data['image'] = $imageName; // Save the image file name to the database
    }else{
        $data['image'] = null;
    }

    Blog::Create([
        'title' => $data['title'],
        'content' => $data['content'],
        'image' => $data['image'],
    ]);

    return redirect('/blog');
}

    function delete($id){ // ทำไมไม่ใช้ eloquant
        DB::table('blogs')->where('id',$id)->delete();
        return redirect('/blog');
    }
    function change($id){
        $blog=DB::table('blogs')->where('id',$id)->first();
        $data=[
            'status'=>!$blog->status
        ];
       $blog= DB::table('blogs')->where('id',$id)->update($data);
        return redirect('/blog');
    }
    function edit($id){
        $blog=DB::table('blogs')->where('id',$id)->first();
        return view('edit',compact('blog'));
    }
    function update(Request $request,$id)
    {
        $request->validate(
            [
                'title' => 'required|max:50',
                'content' => 'required'
            ],
            [
                'title.required' => 'กรุณากรอกชื่อบทความ',
                'title.max' => 'กรุณากรอกชื่อบทความไม่เกิน 50 ตัวอักษร',
                'content.required' => 'กรุณากรอกเนื้อหาบทความ'
            ]
            );
        $data =[
            'title' =>$request ->title,
            'content' =>$request ->content
        ];
        DB::table('blogs')->where('id',$id)->update($data);
        return redirect('/blog');

    }
}
