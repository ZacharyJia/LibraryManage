<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 14:17
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BookController extends BaseController {

    public function bookSearch(Request $request)
    {
        $username = $request->session()->get("username");
        return view('admin\bookSearch', ['username' => $username]);
    }

    public function bookIn(Request $request)
    {

    }

    public function bookBorrow(Request $request)
    {

    }

    public function bookReturn(Request $request)
    {

    }

    public function bookLoss(Request $request)
    {

    }

}