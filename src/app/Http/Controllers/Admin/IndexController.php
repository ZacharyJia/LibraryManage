<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Routing\Controller as BaseController;

/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 13:36
 */

class IndexController extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Harbin");
    }

    public function home(Request $request)
    {
        $username = $request->session()->get("username");

        return view("admin/home", ['username' => $username]);

    }
}