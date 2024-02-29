<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index() {
        // return 'index';
        $book = Book::all();
        return response()->json($book, 200);
    }

    public function show() {
        // return 'show';
        $book = Book::find(1);
        return response()->json($book);
    }

    public function store() {
        // return 'store';
        Book::create(array(
            'ISBN' => '9783298917762',
            'author'  => 'Harold',
            'title' => 'Total zeroadministration ability',
            'price' => 3
        ));
        return response()->json('book craeated');
    }

    public function update() {
        // return 'update';
        $Joe = Book::where('author', '=', '3')->first();
        $Joe->author = 'JoeJoe';
        $Joe->save();

        return response()->json('book updated successfully');
    }

    public function destory() {
        // return 'destory';
        $book = Book::find(51);
        $book->delete();

        return response()->json('book deleted successfully');
    }


}

