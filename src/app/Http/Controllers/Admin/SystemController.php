<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 22:04
 */

namespace app\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Borrow;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SystemController extends BaseController {

    public function overTime(Request $request)
    {
        $num = 1;
        $username = $request->session()->get("username");

        $borrows = Borrow::where("date-should-return", "<", DB::raw("curdate()"))
            ->paginate($num);
        return view("/admin/OverTime", ['username' => $username, "borrows" => $borrows]);
    }

}