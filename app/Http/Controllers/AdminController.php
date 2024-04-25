<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Blog;


try {
    DB::statement('CALL reset_auto_increment()');
    $success = "Successfully reset auto increment is WORKING!!!";
} catch (\Exception $e) {
    $error = "Error: " . $e->getMessage();
}

// การเข้าถึง db ของ laravel มีสองแบบ คือ DB แบบโง่ๆ ที่มึงธรรมทำ
// กับ eloquent https://laravel.com/docs/11.x/eloquent

// สมมุติ มึงมีหน้า blog ก็ทำ controller ของ blog ข้างในมีแค่ เกี่ยวกับblog แค่ insert update delete get
// แล้วถ้ามีหน้า user ก็ทำ controller ของ user
class AdminController extends Controller
{

    // ก็คืออันนี้
    function index()
    {

        /* เข้าใจยัง เข้าใจ เค */
        /* มึงใช้ function index ของ admin controller เพื่อเรียกใช้หน้า blog */
        $blogs = DB::table('blogs')->paginate(5);
        //$test = "ทดสอบส่งตัวแปรไป2";

        // อันนี้ ฟังชั่น compact เป็นการส่งค่าอีกแบบนึง
        //return view('blog', compact('blogs'));
        // ถ้า compact มันจะใช้ชื่อ blogs แล้วก็อ้างอิงตัวแปร $blogs ให้เลย และมันจะส่งไปแบบที่กูเขียนให้ดู เหมือนเป็นฟังชั่นช่วยทำ
        //return view('blog', compact('blogs',));
        //เขียนแบบนี้ก็ได้ จะดูง่ายกว่า
        return view('blog', [
            'blogs' => $blogs,

            // 'test' => "ทดสอบส่งตัวแปรไป2"
        ]);
    }


    function about()
    {
        $name = "lilnon";
        $date = "3 มีนาคม 2557";
        return view('about', compact('name', 'date'));
    }

    // function getCategories()
    // {

    //     $getcategory = DB::table('blogs')->paginate(8);
    //     return view('layouts.app', ['getcategory' => $getcategory

    // ]);


    }

    function iphonex()
    {
        return view('iphonex');
    }
}
