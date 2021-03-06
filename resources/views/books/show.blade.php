@extends('layouts.layout')

@section('title', '蔵書一覧')

@section('content')
    <h1>LaravelBooks</h1>
      <a href="{{url('/create')}}" class="btn btn-info">New</a>
      <table class="table table-striped">
          <tr>
              <th>ID</th>
              <th>書籍名</th>
              <th>出版社</th>
              <th>著者</th>
              <th>価格</th>
              <th>&nbsp;</th>
          </tr>
          @foreach($books as $book)
          <tr>
              <td>{{$book->id}}</td>
              <td>{{$book->title}}</td>
              <td>{{$book->publisher}}</td>
              <td>{{$book->author}}</td>
              <td>{{$book->price}}</td>
              <td><a href="{{url('edit/')}}{{$book->id}}">修正</a> | <a href="{{url('delete/')}}{{$book->id}}">削除</a></td>
          </tr>
          @endforeach
      </table>
@endsection