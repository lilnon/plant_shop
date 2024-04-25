<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Mail\Mailables\Content;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;

// อันนี้เรียกเรียกโดยตรงเลยมันเลยหาตัวแปร $main ไม่เจอ
Route::get('/', function () {
    return view('home');
});

Auth::routes();//wtf
// route ถ้าตั้งชื่อแล้ว ไม่ต้องโยงผ่าน url ใช้ ฟังชั่น route แบบจะโยงให้เอง
// นั้นแหละความแตกต่าง
// มันจะมีประโยชน์ตอนเขียนโปรแกรมใหญ่ๆ แล้วเขียนใน view เยอะ เวลา url ชนกัน จะแก้มันต้องแก้ใหม่หมด ถ้าทำแบบนี้ไม่ต้อง

/////////
Route::get('about',[AdminController::class,'about'])->name('about');


Route::get('/welcome',[ProductsController::class,'main'])->name('main');
// อันนี้หน้า blog
Route::get('blog',[ProductsController::class,'index'])->name('blog');
// [AdminController::class ใช้ admin controller,'index' // ฟังชั่น]
route::get('create',[ProductsController::class,'create'])->name('create');
route::post('insert',[ProductsController::class,'insert']);
route::get('delete/{id}',[ProductsController::class,'delete'])->name('delete');
route::get('change/{id}',[ProductsController::class,'change'])->name('change');
route::get('edit/{id}',[ProductsController::class,'edit'])->name('edit');
route::post('update/{id}',[ProductsController::class,'update'])->name('update');
route::get('report/{id}', [ProductsController::class,'report'])->name('report');

Route::get('/',[AdminController::class,'getCategories']);

// Route::resource('/category', CategoryController::class);
// Route::get('/category', [CategoryController::class, 'index']);
Route::name('category.')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('index');
    Route::get('/category', [CategoryController::class, 'main']);

});

Route::get('/info',function(){
    return phpinfo();
} );
Route::get('/home', [App\Http\Controllers\HomeController::class, 'main2'])->name('home');
