<?php

use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();//wtf
// route ถ้าตั้งชื่อแล้ว ไม่ต้องโยงผ่าน url ใช้ ฟังชั่น route แบบจะโยงให้เอง
// นั้นแหละความแตกต่าง
// มันจะมีประโยชน์ตอนเขียนโปรแกรมใหญ่ๆ แล้วเขียนใน view เยอะ เวลา url ชนกัน จะแก้มันต้องแก้ใหม่หมด ถ้าทำแบบนี้ไม่ต้อง
Route::get('blog',[AdminController::class,'index'])->name('blog');//
Route::get('about',[AdminController::class,'about'])->name('about');
route::get('create',[AdminController::class,'create']);
route::post('insert',[AdminController::class,'insert']);
route::get('delete/{id}',[AdminController::class,'delete'])->name('delete');
route::get('change/{id}',[AdminController::class,'change'])->name('change');
route::get('edit/{id}',[AdminController::class,'edit'])->name('edit');
route::post('update/{id}',[AdminController::class,'update'])->name('update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
