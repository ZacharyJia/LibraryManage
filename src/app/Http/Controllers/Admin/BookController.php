<?php
/**
 * Created by PhpStorm.
 * User: jia19
 * Date: 2015/11/18
 * Time: 14:17
 */

namespace App\Http\Controllers\Admin;

use App\Borrow;
use App\Category;
use App\Book;
use App\Level;
use App\Reader;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class BookController extends BaseController {

    public function __construct()
    {
        //设置时区，用于处理日期生成
        date_default_timezone_set("Asia/Harbin");
    }


    //图书搜索界面显示
    public function bookSearch(Request $request)
    {
        $username = $request->session()->get("username");
        $categories = Category::all();
        return view('admin/BookSearch', ['username' => $username, 'categories' => $categories]);
    }

    //获取图书类别，将其转换为数组
    private function getCategoryArray($categories)
    {
        $result = array();
        foreach($categories as $category)
        {
            $result[$category['id']] = $category['category'];
        }
        return $result;
    }


    //处理图书搜索请求
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

        //生成查询语句，各个where之间为and关系
        $books = Book::where("book-name", "like", '%'.$name.'%')
                        ->where("author", "like", '%'. $author . '%')
                        ->where('publishing', 'like', '%'.$publishing.'%')
                        ->where('category-id', '=', $category)
                        ->where('isbn', 'like', '%'.$isbn.'%')
                        ->paginate($num);//分页

        //将搜索选项添加到参数中，用于自动生成分页
        $books->appends(["name" => $name, "author" => $author, "publishing" => $publishing, "category" => $category, "isbn" => $isbn]);
        return view('admin/BookList', ['username' => $username, 'books' => $books, 'categories' => $categories]);
    }

    //图书详情页面显示
    public function bookDetail(Request $request)
    {
        $msg = $request->session()->get("msg");
        $username = $request->session()->get("username");
        $categories = Category::all();

        $id = $request->input("id");
        $book = Book::find($id);

        $view = view('admin/BookDetail', ['username' => $username, "categories" => $categories, "book" => $book]);
        if ($msg == null)//判断是否有错误信息需要显示，有需要则显示出错误信息
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    //保存对图书信息的修改
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


    //图书入库界面显示
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

    //图书入库请求处理
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

        //处理成功就返回添加页面
        return redirect('/admin/bookIn')->with("msg", "入库成功");
    }

    //图书借阅界面
    public function bookBorrow(Request $request)
    {
        $username = $request->session()->get("username");
        $msg = $request->session()->get("msg");

        $view = view('/admin/BookBorrow', ['username' => $username]);
        if($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    //图书借阅请求处理
    public function bookBorrowAction(Request $request)
    {
        $date = date("Y-m-d");
        $reader_id = $request->input("reader-id");
        $isbn = $request->input("isbn");

        $reader = Reader::find($reader_id);
        //对输入信息进行检查
        if ($reader == null)
        {
            return redirect('/admin/bookBorrow')->with("msg", "读者证编号有误，请检查！");
        }
        if ($reader['loss'] == true)
        {
            //挂失处理
            return redirect('/admin/bookBorrow')->with("msg", "该借书证已挂失，请先解挂后再借书！");
        }
        $book = Book::where("isbn", '=', $isbn)->first();
        if ($book == null)
        {
            return redirect('/admin/bookBorrow')->with("msg", "图书ISBN有误，请检查！");
        }
        if( $book['quantity-in'] - $book['quantity-out'] - $book['quantity-loss'] < 1)
        {
            return redirect('/admin/bookBorrow')->with("msg", "图书数量不足，请检查ISBN！");
        }

        $level = Level::find($reader['level']);
        $borrowedBookNum = Borrow::where("reader-id", '=', $reader_id)
                                ->where("returned", '=', false)
                                ->where('loss', '<>', true)
                                ->get()
                                ->count();
        if($borrowedBookNum >= $level['numbers'])
        {
            //借书数量限制
            return redirect('/admin/bookBorrow')->with("msg", "该用户借书数量超过限制，请先归还部分图书！");
        }

        $book['quantity-out'] += 1;
        $book->save();

        $borrow = new Borrow();
        $shouldReturnDate = date("Y-m-d", strtotime("+".$level['days']." days"));

        $borrow['reader-id'] = $reader_id;
        $borrow['book-id'] = $book['book-id'];
        $borrow['date-borrow'] = $date;
        $borrow['date-should-return'] = $shouldReturnDate;

        $borrow->save();

        return redirect('/admin/bookBorrow')->with("msg", "借阅成功！");
    }

    //图书返还页面
    public function bookReturn(Request $request)
    {
        $username = $request->session()->get("username");
        $msg = $request->session()->get("msg");

        $view = view('/admin/BookReturn', ['username' => $username]);
        if($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    //图书返还请求
    public function bookReturnAction(Request $request)
    {
        $date = date("Y-m-d");
        $reader_id = $request->input("reader-id");
        $isbn = $request->input("isbn");

        $book = Book::where("isbn", '=', $isbn)->first();
        if ($book == null)
        {
            return redirect('/admin/bookReturn')->with("msg", "读者证编号有误，请检查！");
        }

        //查找借阅信息
        $borrow = Borrow::where("reader-id", '=', $reader_id)
                        ->where("book-id", '=', $book['book-id'])
                        ->where('loss', '=', false)
                        ->where("returned", '=', false)
                        ->first();
        if ($borrow == null)
        {
            return redirect('/admin/bookReturn')->with("msg", "信息有误，请检查！");
        }

        $book['quantity-out'] = $book['quantity-out'] - 1;
        $book->save();
        $borrow['date-return'] = $date;
        $borrow['returned'] = true;
        $borrow->save();

        return redirect('/admin/bookReturn')->with("msg", "图书归还成功，欢迎继续使用！");

    }

    //图书挂失页面
    public function bookLoss(Request $request)
    {
        $username = $request->session()->get("username");
        $msg = $request->session()->get("msg");

        $view = view('/admin/BookLoss', ['username' => $username]);
        if($msg == null)
        {
            return $view;
        }
        else
        {
            return $view->with("msg", $msg);
        }
    }

    //图书挂失页面请求处理
    public function bookLossAction(Request $request)
    {
        $reader_id = $request->input("reader-id");
        $isbn = $request->input("isbn");

        $book = Book::where("isbn", '=', $isbn)->first();
        if ($book == null)
        {
            return redirect('/admin/bookLoss')->with("msg", "读者证编号有误，请检查！");
        }
        if ($book['quantity-out'] + $book['quantity-loss'] + 1 > $book['quantity-in'])
        {
            return redirect('/admin/bookLoss')->with("msg", "图书信息有误，请检查！");
        }

        $borrow = Borrow::where("reader-id", '=', $reader_id)
            ->where("book-id", '=', $book['book-id'])
            ->where("returned", '=', 0)
            ->first();
        if ($borrow == null)
        {
            return redirect('/admin/bookLoss')->with("msg", "信息有误，请检查！");
        }

        $book['quantity-out'] = $book['quantity-out'] - 1;
        $book['quantity-Loss'] += 1;
        $book->save();
        $borrow['loss'] = true;
        $borrow->save();

        return redirect('/admin/bookLoss')->with("msg", "图书挂失成功！");

    }
}
