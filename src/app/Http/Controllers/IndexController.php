<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;


class IndexController extends BaseController
{
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
        if ($user && $user['password'] == $request->input('password'))
        {
            return view("welcome",["msg"=>"登录成功！"]);
        }
        else
        {
            return redirect('login')->with('errormsg', '用户名或密码错误!');
        }
    }
    

}
