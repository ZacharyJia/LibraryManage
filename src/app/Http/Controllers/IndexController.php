<?php
namespace App\Http\Controllers;

use App\Book as Book;
use DB;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    public function dbTest()
    {
        //DB::insert("insert into `member-level`(days, numbers, fee) values(?, ?, ?)", [10, 2, 10.2]);
        
        return view("index", ["msg" => "hello laravel"]);
    }
}
