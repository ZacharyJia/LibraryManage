<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 23:10
 */

namespace app\Http\Controllers\Reader;

use App\Book;
use App\Borrow;
use App\Category;
use App\Level;
use App\Reader;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController {

    public function __construct()
    {
        date_default_timezone_set("Asia/Harbin");
    }

    //主页面
    public function home(Request $request)
    {
        $username = $request->session()->get("username");
        $reader = Reader::find($request->session()->get("reader-id"));
        $levels = Level::all();
        $borrows = Borrow::where("reader-id", "=", $reader['reader-id'])
                    ->where('loss', '=', false)
                    ->where('returned', '=', false)
                    ->get();
        return view("/reader/home", ['username' => $username, 'reader' => $reader, 'levels' => $levels, 'borrows' => $borrows]);
    }

    //普通搜索，提供一个关键字，在多个字段中搜索
    public function search(Request $request)
    {
        $num = 10;
        $username = $request->session()->get("username");
        $keyword = $request->input("keyword");

        if($keyword == "")
        {
            return redirect('/');
        }

        //生成查询
        $books = Book::where('book-name', 'like', '%'.$keyword.'%')
                    ->where('author', 'like', '%'.$keyword.'%')
                    ->where('isbn', 'like', '%'.$keyword.'%')
                    ->paginate($num);
        $books->appends(['keyword' => $keyword]);

        $categories = $this->getCategoryArray(Category::all());
        return view('/reader/BookList', ['username' => $username, 'books' => $books, 'categories' => $categories]);
    }

    private function getCategoryArray($categories)
    {
        $result = array();
        foreach($categories as $category)
        {
            $result[$category['id']] = $category['category'];
        }
        return $result;
    }

    //高级搜索，指定搜索字段
    public function advancedSearch(Request $request)
    {
        $username = $request->session()->get("username");
        $categories = Category::all();
        return view('/reader/AdvancedSearch', ['username' => $username, 'categories' => $categories]);
    }

    //高级搜索处理
    public function advancedSearchAction(Request $request)
    {
        $num = 10;
        $username = $request->session()->get("username");
        $name = $request->input("name");
        $author = $request->input("author");
        $publishing = $request->input("publishing");
        $category = $request->input("category");
        $isbn = $request->input("isbn");

        $books = Book::where("book-name", "like", '%'.$name.'%')
            ->where("author", "like", '%'. $author . '%')
            ->where('publishing', 'like', '%'.$publishing.'%')
            ->where('category-id', '=', $category)
            ->where('isbn', 'like', '%'.$isbn.'%')
            ->paginate($num);

        $books->appends(["name" => $name, "author" => $author, "publishing" => $publishing, "category" => $category, "isbn" => $isbn]);

        $categories = $this->getCategoryArray(Category::all());
        return view('/reader/BookList', ['username' => $username, 'books' => $books, 'categories' => $categories]);

    }

    //借阅历史
    public function history(Request $request)
    {
        $num = 10;
        $username = $request->session()->get("username");

        $user = User::where('username', '=', $username)->first();
        if($user == null)
        {
            return redirect('/reader/home');
        }

        $borrows = Borrow::where('reader-id', '=', $user['reader-id'])
                        ->orderBy('id')
                        ->paginate($num);

        return view('/reader/history', ['username' => $username, 'borrows' => $borrows]);
    }

    //个人信息显示
    public function info(Request $request)
    {
        $username = $request->session()->get("username");
        $user = User::where('username', '=', $username)->first();
        if($user == null)
        {
            return redirect('home');
        }
        $reader = Reader::find($user['reader-id']);
        $levels = Level::all();

        return view('/reader/info', ['username' => $username, 'user' => $user, 'reader' => $reader, 'levels' => $levels]);
    }

    //个人信息修改保存
    public function infoSave(Request $request)
    {
        $username = $request->session()->get("username");
        $user = User::where('username', '=', $username)->first();
        if($user == null)
        {
            return redirect('home');
        }
        $reader = Reader::find($user['reader-id']);

        $reader['reader-name'] = $request->input("reader-name");
        $reader['sex'] = $request->input("sex");
        $reader['birthday'] = $request->input("birthday");
        $reader['phone'] = $request->input('phone');
        $reader['mobile'] = $request->input('mobile');

        $reader->save();

        return redirect('/reader/info');
    }
}