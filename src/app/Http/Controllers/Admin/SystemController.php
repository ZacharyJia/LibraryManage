<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 22:04
 */

namespace app\Http\Controllers\Admin;

use App\Level;
use App\Reader;
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

    //逾期未还页面
    public function overTime(Request $request)
    {
        $num = 10;
        $username = $request->session()->get("username");

        $borrows = Borrow::where("date-should-return", "<", DB::raw("curdate()"))
            ->paginate($num);
        return view("/admin/OverTime", ['username' => $username, "borrows" => $borrows]);
    }

    //等级管理
    public function levelManage(Request $request)
    {
        $username = $request->session()->get("username");
        $levels = Level::all();
        $msg = $request->session()->get("msg");
        $view = view('/admin/LevelManage', ['username' => $username, 'levels' => $levels]);
        if ($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    //等级删除
    public function levelDel(Request $request)
    {
        $level = $request->input("level");

        $readerNum = Reader::where('level', '=', $level)
                        ->count();
        if($readerNum > 0)
        {
            return redirect("/admin/levelManage")->with("msg", "还有用户在此等级，无法删除！");
        }

        $l = Level::find($level);

        $l->delete();

        return redirect("/admin/levelManage")->with("msg", "删除成功！");
    }

    //添加新等级
    public function levelAdd(Request $request)
    {
        $username = $request->session()->get("username");
        $msg = $request->session()->get("msg");

        $view = view('/admin/LevelAdd', ['username' => $username]);
        if ($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    public function levelAddAction(Request $request)
    {
        $level = $request->input("level");
        $days = $request->input("days");
        $numbers = $request->input("numbers");
        $fee = $request->input("fee");

        $l = new Level();
        $l['level'] = $level;
        $l['days'] = $days;
        $l['numbers'] = $numbers;
        $l['fee'] = $fee;

        $l->save();
        return redirect("/admin/levelManage")->with("msg", "添加成功！");
    }

    //密码修改页面
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

    //密码修改
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