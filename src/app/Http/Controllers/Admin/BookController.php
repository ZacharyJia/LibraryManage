<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 14:17
 */

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BookController extends BaseController {

    public function bookSearch(Request $request)
    {
        $username = $request->session()->get("username");
        $categories = Category::all();
        return view('admin\bookSearch', ['username' => $username, 'categories' => $categories]);
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


    public function bookSearchAction(Request $request)
    {
        $num = 10;
        $username = $request->session()->get("username");
        $categories = $this->getCategoryArray(Category::all());

        $name = $request->input("name");
        $author = $request->input("author");
        $publishing = $request->input("publishing");
        $category = $request->input("category");

        $books = Book::where("book-name", "like", '%'.$name.'%')
                        ->where("author", "like", '%'. $author . '%')
                        ->where('publishing', 'like', '%'.$publishing.'%')
                        ->where('category-id', '=', $category)
                        ->paginate($num);

        $books->appends(["name" => $name, "author" => $author, "publishing" => $publishing, "category" => $category]);
        return view('admin\BookList', ['username' =>$username, 'books' => $books, 'categories' => $categories]);
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