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

    public function __construct()
    {
        date_default_timezone_set("Asia/Harbin");
    }

    //读者证办理页面
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

    //创建读者证
    //分别在reader表和user表插入新的纪录
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

        if ($sex != '男' && $sex != '女'){
            return redirect('/admin/cardCreate')->with("msg", "参数错误，请重试");
        }
        if($reader_name == "" || $sex == "" || $birthday == "" || $phone == ""
            || $mobile == "" || $card_name == "" || $card_id == "" || $level == "" || $username == "" || $password == "")
        {
            return redirect('/admin/cardCreate')->with("msg", "参数错误，请重试");
        }

        //为了防止出现数据不一致的情况，使用事务进行处理
        //如果出现错误的话，就将操作回滚，正常则提交
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

    //读者搜索页面
    public function readerSearch(Request $request)
    {
        $username = $request->session()->get("username");
        return view('admin/ReaderSearch', ['username' => $username]);
    }

    public function readerSearchAction(Request $request)
    {
        $num = 10;

        $username = $request->session()->get("username");
        $reader_name = $request->input("reader-name");
        $reader_id = $request->input("reader-id");

        $readers = Reader::where('reader-id', 'like', '%'.$reader_id."%")
                        ->where('reader-name', 'like', '%'.$reader_name.'%')
                        ->paginate($num);

        $readers->appends(['reader-name' => $reader_name, 'reader-id' => $reader_id]);
        return view('admin/ReaderList', ['username' => $username, 'readers' => $readers]);
    }

    //读者信息页面
    public function readerDetail(Request $request)
    {
        $msg = $request->session()->get("msg");
        $username = $request->session()->get("username");
        $id = $request->input("id");
        $reader = Reader::find($id);
        $user = User::where('reader-id', '=', $id)
            ->first();
        $levels = Level::all();

        $view = view('admin/ReaderDetail', ['username' => $username, 'reader' => $reader, 'user' => $user, "levels" => $levels]);

        if ($msg == null) {
            return $view;
        } else {
            return $view->with("msg", $msg);
        }

    }

    //保存读者信息
    public function readerSaveAction(Request $request)
    {
        $id = $request->input("reader-id");
        $reader_name = $request->input("reader-name");
        $sex = $request->input("sex");
        $birthday = $request->input("birthday");
        $phone = $request->input("phone");
        $mobile = $request->input("mobile");
        $card_name = $request->input("card-name");
        $card_id = $request->input("card-id");
        $level = $request->input("level");
        $username = $request->input("username");

        $reader = Reader::find($id);
        if($reader == null)
        {
            return redirect('/admin/readerDetail?id='.$id)->with("msg", "保存失败！");
        }
        $user = User::where('reader-id', '=', $id)->first();
        if($user == null)
        {
            return redirect('/admin/readerDetail?id='.$id)->with("msg", "保存失败！");
        }

        $reader['reader-name'] = $reader_name;
        $reader['sex'] = $sex;
        $reader['birthday'] = $birthday;
        $reader['phone'] = $phone;
        $reader['mobile'] = $mobile;
        $reader['card-name'] = $card_name;
        $reader['card-id'] = $card_id;
        $reader['level'] = $level;
        $reader->save();

        $user['username'] = $username;
        $user->save();

        return redirect('/admin/readerDetail?id='.$id)->with("msg", "保存成功！");
    }

    //读者证挂失
    public function readerLoss(Request $request)
    {
        $username = $request->session()->get("username");
        $msg = $request->session()->get("msg");

        $view = view('/admin/ReaderLoss', ['username' => $username]);
        if($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    //读者证挂失处理
    public function readerLossAction(Request $request)
    {
        $id = $request->input('reader-id');
        $reader = Reader::find($id);
        if($reader == null)
        {
            return redirect('/admin/readerLoss')->with("msg", "该读者证不存在，请重试！");
        }
        //将读者证的loss字段标记为true
        $reader['loss'] = true;
        $reader->save();
        return redirect('/admin/readerLoss')->with("msg", "读者证".$id."挂失成功！");
    }

    //读者证解挂页面
    public function readerFound(Request $request)
    {
        $username = $request->session()->get("username");
        $msg = $request->session()->get("msg");

        $view = view('/admin/ReaderFound', ['username' => $username]);
        if($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    //读者证解挂处理
    public function readerFoundAction(Request $request)
    {
        $id = $request->input('reader-id');
        $reader = Reader::find($id);
        if($reader == null)
        {
            return redirect('/admin/readerFound')->with("msg", "该读者证不存在，请重试！");
        }
        if($reader['loss'] == false)
        {
            return redirect('/admin/readerFound')->with("msg", "该读者证未挂失过！");
        }
        $reader['loss'] = false;
        $reader->save();
        return redirect('/admin/readerFound')->with("msg", "读者证".$id."解挂成功！");
    }
}
