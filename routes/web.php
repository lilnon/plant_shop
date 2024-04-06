<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Mail\Mailables\Content;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

// อันนี้เรียกเรียกโดยตรงเลยมันเลยหาตัวแปร $main ไม่เจอ
Route::get('/', function () {
    return view('home');
});


Route::get('/welcome',[AdminController::class,'main'])->name('main');


Auth::routes();//wtf
// route ถ้าตั้งชื่อแล้ว ไม่ต้องโยงผ่าน url ใช้ ฟังชั่น route แบบจะโยงให้เอง
// นั้นแหละความแตกต่าง
// มันจะมีประโยชน์ตอนเขียนโปรแกรมใหญ่ๆ แล้วเขียนใน view เยอะ เวลา url ชนกัน จะแก้มันต้องแก้ใหม่หมด ถ้าทำแบบนี้ไม่ต้อง

// อันนี้หน้า blog
Route::get('blog',[AdminController::class,'index'])->name('blog');
// [AdminController::class ใช้ admin controller,'index' // ฟังชั่น]

/////////
Route::get('about',[AdminController::class,'about'])->name('about');
route::get('create',[AdminController::class,'create'])->name('create');
route::post('insert',[AdminController::class,'insert']);
route::get('delete/{id}',[AdminController::class,'delete'])->name('delete');
route::get('change/{id}',[AdminController::class,'change'])->name('change');
route::get('edit/{id}',[AdminController::class,'edit'])->name('edit');
route::post('update/{id}',[AdminController::class,'update'])->name('update');

Route::get('/',[AdminController::class,'getCategories']);

// Route::resource('/category', CategoryController::class);
// Route::get('/category', [CategoryController::class, 'index']);
Route::name('category.')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('index');
});


Route::get('iphonex',[AdminController::class,'iphonex'])->name('iphonex');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
