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
        $isbn = $request->input("isbn");

        $books = Book::where("book-name", "like", '%'.$name.'%')
                        ->where("author", "like", '%'. $author . '%')
                        ->where('publishing', 'like', '%'.$publishing.'%')
                        ->where('category-id', '=', $category)
                        ->where('isbn', '=', $isbn)
                        ->paginate($num);

        $books->appends(["name" => $name, "author" => $author, "publishing" => $publishing, "category" => $category, "isbn" => $isbn]);
        return view('admin\BookList', ['username' => $username, 'books' => $books, 'categories' => $categories]);
    }

    public function bookDetail(Request $request)
    {
        $msg = $request->session()->get("msg");
        $username = $request->session()->get("username");
        $categories = Category::all();

        $id = $request->input("id");
        $book = Book::find($id);

        $view = view('admin\BookDetail', ['username' => $username, "categories" => $categories, "book" => $book]);
        if ($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    public function bookSave(Request $request)
    {
        $id = $request->input("id");
        $name = $request->input("name");
        $isbn = $request->input("isbn");
        $author = $request->input("author");
        $publishing = $request->input("publishing");
        $price = $request->input("price");
        $date_in = $request->input("date-in");
        $quantity_in = $request->input("quantity-in");
        $category = $request->input("category");

        $book = Book::find($id);
        $book['book-name'] = $name;
        $book['author'] = $author;
        $book['publishing'] = $publishing;
        $book['category-id'] = $category;
        $book['price'] = $price;
        $book['date-in'] = $date_in;
        $book['quantity-in'] = $quantity_in;
        $book['isbn'] = $isbn;

        $book->save();
        return redirect('/admin/bookDetail?id=' . $id)->with("msg", "保存成功");
    }


    public function bookIn(Request $request)
    {
        $msg = $request->session()->get("msg");
        $username = $request->session()->get("username");
        $categories = Category::all();

        $view = view("/admin/BookIn", ['username' => $username, 'categories' => $categories]);
        if($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }

    }

    public function bookInAction(Request $request)
    {
        $name = $request->input("name");
        $author = $request->input("author");
        $publishing = $request->input("publishing");
        $price = $request->input("price");
        $quantity_in = $request->input("quantity-in");
        $category = $request->input("category");
        $isbn = $request->input("isbn");

        $book = new Book();
        $book['book-name'] = $name;
        $book['author'] = $author;
        $book['publishing'] = $publishing;
        $book['category-id'] = intval($category);
        $book['price'] = $price;
        $book['date-in'] = date("Y-m-d");
        $book['quantity-in'] = $quantity_in;
        $book['isbn'] = $isbn;

        $book->save();

        return redirect('/admin/bookIn')->with("msg", "入库成功");
    }

    public function bookBorrow(Request $request)
    {
        $username = $request->session()->get("username");

        return view('/admin/BookBorrow', ['username' => $username]);
    }

    public function bookReturn(Request $request)
    {

    }

    public function bookLoss(Request $request)
    {

    }

}