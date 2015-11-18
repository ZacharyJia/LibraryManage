<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 18:18
 */

namespace app\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Level;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Reader;
use Mockery\CountValidator\Exception;

class ReaderController extends BaseController {

    public function cardCreate(Request $request)
    {
        $msg = $request->session()->get("msg");
        $username = $request->session()->get("username");
        $levels = Level::all();

        $view = view("/admin/CardCreate", ['username' => $username, "levels" => $levels]);
        if($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    public function cardCreateAction(Request $request)
    {
        $reader_name = $request->input("reader-name");
        $sex = $request->input("sex");
        $birthday = $request->input("birthday");
        $phone = $request->input("phone");
        $mobile = $request->input("mobile");
        $card_name = $request->input("card-name");
        $card_id = $request->input("card-id");
        $level = $request->input("level");
        $username = $request->input("username");
        $password = md5($request->input('password')."zachary");

        DB::beginTransaction();

        try {
            $reader = new Reader();
            $reader['reader-name'] = $reader_name;
            $reader['sex'] = $sex;
            $reader['birthday'] = $birthday;
            $reader['phone'] = $phone;
            $reader['mobile'] = $mobile;
            $reader['card-name'] = $card_name;
            $reader['card-id'] = $card_id;
            $reader['level'] = $level;
            $reader['day'] = date('Y-m-d');

            $reader->save();

            $user = new User();
            $user['username'] = $username;
            $user['password'] = $password;
            $user['type'] = 1;
            $user['reader-id'] = $reader['reader-id'];
            $user->save();

            DB::commit();
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            DB::rollback();
            return redirect('/admin/cardCreate')->with("msg", "出现错误，请重试");
        }


        return redirect('/admin/cardCreate')->with("msg", "创建成功！新的读者证编号为：".$reader['reader-id']);

    }


}