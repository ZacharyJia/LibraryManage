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
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController {

    public function __construct()
    {
        date_default_timezone_set("Asia/Harbin");
    }

    public function home(Request $request)
    {
        $username = $request->session()->get("username");
        return view("/reader/home", ['username' => $username]);
    }

    public function search(Request $request)
    {
        $num = 10;
        $username = $request->session()->get("username");
        $keyword = $request->input("keyword");

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

    public function advancedSearch(Request $request)
    {
        $username = $request->session()->get("username");
        $categories = Category::all();
        return view('/reader/AdvancedSearch', ['username' => $username, 'categories' => $categories]);
    }

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

}