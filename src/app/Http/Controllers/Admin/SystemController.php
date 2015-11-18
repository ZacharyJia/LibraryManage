<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 22:04
 */

namespace app\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Borrow;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SystemController extends BaseController {

    public function __construct()
    {
        date_default_timezone_set("Asia/Harbin");
    }

    public function overTime(Request $request)
    {
        $num = 10;
        $username = $request->session()->get("username");

        $borrows = Borrow::where("date-should-return", "<", DB::raw("curdate()"))
            ->paginate($num);
        return view("/admin/OverTime", ['username' => $username, "borrows" => $borrows]);
    }

    public function changePassword(Request $request)
    {
        $username = $request->session()->get("username");
        $msg = $request->session()->get("msg");

        $view = view("/admin/ChangePassword", ['username' => $username]);
        if ($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    public function changePasswordAction(Request $request)
    {
        $username = $request->session()->get("username");
        $old_password = md5($request->input("old-password")."zachary");
        $password = md5($request->input("password")."zachary");

        $user = User::where('username', '=', $username)->first();
        if ($user['password'] == $old_password)
        {
            $user['password'] = $password;
        }
        else
        {
            return redirect('/admin/changePassword')->with("msg", "原密码错误，请重试！");
        }

        $user->save();
        return redirect('/admin/changePassword')->with("msg", "修改成功！");
    }
}