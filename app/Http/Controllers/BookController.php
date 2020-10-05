<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;

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
        //validation追加
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'author' => 'required',
            'price'=> 'integer|min:0',
        ]);

        if($validator->fails()){
            return redirect('create/')->withErrors($validator)->withInput();
        }

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

    public function edit($id){
        $book = Book::find($id);
        if(is_null($book)){
        abort(404);
        }
        return view('books/edit', ['book'=>$book]);
    }

    public function update(Request $request,$id){
        //validation追加
        $validator = Validator::make($request->all(),[
        'title' => 'required',
        'author' => 'required',
        'price'=> 'integer|min:0',
    ]);

    if($validator->fails()){
        return redirect('create/')->withErrors($validator)->withInput();
    }

    $book = Book::find($id);
    $book->title = $request->title;
    $book->author = $request->author;
    $book->publisher = $request->publisher;
    $book->price = $request->price;
    $book->save();

    return redirect('/');
    }

    public function delete($id){
        $book = Book::find($id);
        if(is_null($book)){
           abort(404);
        }
        return view('books/delete', ['book'=>$book]);
    }

    public function remove($id){
        $book = Book::find($id);
        $book->delete();

        return redirect('/');
    }
}
