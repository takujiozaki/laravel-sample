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

    public function store(Request $request){
        $book = new Book();
        $book -> title = $request -> title;
        $book -> author = $request -> author;
        $book -> publisher = $request -> publisher;
        $book -> price = $request -> price;
        $book -> created_at = now();
        $book -> updated_at = now();
        $book -> save();
     
        return redirect('/');
     
     }
}
