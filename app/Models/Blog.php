<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;


    // ประกาศให้ db เข้าสู่ column พวกนี้ได้
    // ถ้าไม่เพิ่ม จะไม่สามารถ แก้ไข เพิ่ม หรือ อัพเดทได้
    // db เปลี่ยนไปใช้ eloquent ให้หมด
    protected $fillable = [
        'title',
        'content',
        'price',
        'status',
        'image'
    ];
}
