@extends('layouts.layout')

@section('title', '蔵書削除')

@section('content')
<h1>LaravelBooks</h1>
    <a href="{{url('/')}}" class="btn btn-info">Back</a>
    <form action="" method="post">
    @csrf
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{$book->id}} <input type="hidden" name="id" value="{{$book->id}}"></td>
        </tr>
        <tr>
            <th>書籍名</th>
            <td>{{$book->title}}</td>
        </tr>
        <tr>
            <th>出版社名</th>
            <td>{{$book->publisher}}</td>
        </tr>
        <tr>
            <th>著者</th>
            <td>{{$book->author}}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{$book->price}}</td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary">この蔵書を削除</button>
    </form>
@endsection