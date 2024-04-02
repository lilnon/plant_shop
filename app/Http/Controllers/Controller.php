<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/*

controller ไม่ควรใข้อันเดียวครอบจักรวาล



*/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
