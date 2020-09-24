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
          </tr>
          <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
          </tr>
      </table>
@endsection