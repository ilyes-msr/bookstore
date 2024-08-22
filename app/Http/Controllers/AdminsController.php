<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
    public function index()
    {
        $number_of_books = Book::count();
        $number_of_categories = Category::count();
        $number_of_authors = Author::count();
        $number_of_publishers = Publisher::count();

        return view('admin.index', compact('number_of_books', 'number_of_categories', 'number_of_authors', 'number_of_publishers'));
    }

    public function allPurchases()
    {

        $allPurchases = DB::table('book_user')
            ->join('users', 'users.id', '=', 'book_user.user_id')
            ->join('books', 'books.id', '=', 'book_user.book_id')
            ->select('book_user.*', 'users.name', 'books.title')
            ->where('bought', 1)
            ->get();

        // dd($allPurchases);
        return view('admin.all-purchases', compact('allPurchases'));
    }
}
