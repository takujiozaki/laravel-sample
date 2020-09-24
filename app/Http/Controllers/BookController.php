<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function show(){
        $books = Book::all();
        $context = ['books' => $books];
        return view('books/show', $context);
    }

    public function create(){
        return view('books/create');
    }
}
