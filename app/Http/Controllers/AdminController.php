<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

    try {
        DB::statement('call reset_auto_increment()');
        $sucess = "successfully reset auto increment isWORKING!!!";
    } catch (\Exception $e) {
        $error = "Error: " . $e->getMessage();
    }


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
    function insert(Request $request)
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
        $data=[
            'title'=>$request->title,
            'content'=>$request->content
        ];
        DB::table('blogs')->insert($data);
        return redirect('/blog');
    }
    function delete($id){
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
