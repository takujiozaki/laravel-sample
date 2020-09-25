@extends('layouts.layout')

@section('title', '新規蔵書')

@section('content')
<h1>LaravelBooks</h1>
    <a href="{{url('/')}}" class="btn btn-info">Back</a>
    <form action="" method="post">
    @csrf
    <table class="table">
        <tr>
            <th>ID</th>
            <td>#</td>
        </tr>
        <tr>
            <th>書籍名</th>
            <td><input type="text" name="title" id=""></td>
        </tr>
        <tr>
            <th>出版社名</th>
            <td><input type="text" name="publisher" id=""></td>
        </tr>
        <tr>
            <th>著者</th>
            <td><input type="text" name="author" id=""></td>
        </tr>
        <tr>
            <th>価格</th>
            <td><input type="number" name="price" id=""></td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary">送信</button>
    </form>
@endsection