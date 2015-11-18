<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Routing\Controller as BaseController;


class IndexController extends BaseController
{

    public function __construct()
    {
        date_default_timezone_set("Asia/Harbin");
    }

    public function dbTest()
    {
        //DB::insert("insert into `member-level`(days, numbers, fee) values(?, ?, ?)", [10, 2, 10.2]);
        
        return view("index", ["msg" => "hello laravel"]);
    }

    public function login(Request $request)
    {
        $errorMsg = $request->session()->get("errormsg");
        if ($errorMsg == null) {
            return view("login");
        }
        else
        {
            return view("login",["errormsg"=>$errorMsg]);
        }
    }

    public function loginAction(Request $request)
    {
        $user = User::where('username', '=', $request->input('username'))->first();
        $password = md5($request->input('password')."zachary");
        if ($user && $user['password'] == $password)
        {
            $request->session()->put("isLogin", true);
            $request->session()->put("type", $user['type']);
            $request->session()->put("username", $user['username']);

            //管理员用户
            if($user['type'] == 0)
            {
                return redirect('/admin/home');
            }
            //读者用户
            else if($user['type'] == 1)
            {

                return redirect('/reader/home');
            }
        }
        else
        {
            return redirect('login')->with('errormsg', '用户名或密码错误!');
        }
    }

    public function logoutAction(Request $request)
    {
        $request->session()->clear();
        return redirect('/login');
    }
    

}
