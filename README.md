# 簡単な蔵書アプリケーションをLaravelで作成

## composerのインストールを確認

```コマンドプロンプト
composer --version
Composer version 1.10.10 .......
```
## INSTALL
install コマンド(要composer)  
```
composer create-project --prefer-dist laravel/laravel demo "6.*"
```
*laravel new app名 では最新バージョンがインストールされるので注意  

## installディレクトリ
開発サーバーで運用するなら場所は問わない。  
デスクトップやホームディレクトリでも可。  
*複数のアプリケーションを開発することもあるのでXAMPPのルートを使用することは避けた方が無難。  
*開発サーバーor仮想サーバー(docker/virtualbox)を利用するのが一般的。  

## TEST起動
インストールディレクトリに入り、php artisan serve

## 初期設定
```config/app.php
'timezone' => 'Asia/Tokyo',
 'locale' => 'ja',
```

## ページレイアウト
投稿画面、一覧画面を作成
/resourses/view/books内にxxx.blade.htmlで作成  
*表示確認後拡張子をphpに修正.  
## ルーティング(1)
一覧表示(get)   
登録(get)  
```routes/web.php
Route::get('/', function () {
     return view('books/show');
});

Route::get('/create', function(){
     return view('books/create');
});
```
テンプレートでリンクの確認.  
## ルーティング(2)
controllerにまとめる  
```
php .\artisan make:controller BookController
```
```
public function show(){
    return view('books/show');
}

public function create(){
    return view('books/create');
}
```
## テンプレート化
基本テンプレートをlayout.blade.phpにまとめる  
@extends('ディレクトリ.テンプレート名の拡張子不要')の書式に注意
## データベース設定
### DBを作成 
``` MySQL Monitor
create database laravel default charset utf8mb4;
create user 'lara'@'localhost' identified by 'abcd';
grant all on laravel.* to 'lara'@'localhost';
```
### .envを修正
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_demo
DB_USERNAME=lara
DB_PASSWORD=abcd
```
### migrationファイルを作成
```
php artisan make:migration create_books_table
```
### カラム設定
```xxxx_xx_xx_xxxxx_create_books_table.php
public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->integer('price');
            $table->timestamps();
        });
    }
```
### migration
```
php artisan migrate
```
### rollbackとflesh
```
php artisan migrate:rollback
php artisan migrate:fresh

```
### 初期データの投入
seederによる初期データの投入
```
php artisan make:seeder BooksTableSeeder
```
```database/seeds/BooksTableSeeder.php
public function run()
    {
        $current_time = date("Y-m-d H:i:s");
        $books = [];
        $books[0] = [
            'title'=>"Laravel マスターブック",
            'author'=>'白石護',
            'publisher'=>'衆映社',
            'price'=>2900,
            'created_at' => $current_time,
            'updated_at' => $current_time
        ];

        $books[1] = [
            'title'=>"Laravel 逆引き辞典",
            'author'=>'松浦恵一他',
            'publisher'=>'コトブキ出版',
            'price'=>1980,
            'created_at' => $current_time,
            'updated_at' => $current_time
        ];

        $books[2] = [
            'title'=>"みんなのPHP",
            'author'=>'PHPユーザーグループ他',
            'publisher'=>'評論技術社',
            'price'=>2180,
            'created_at' => $current_time,
            'updated_at' => $current_time
        ];


        DB::table('books')->insert($books);

    }
```
```
php .\artisan db:seed --class BooksTableSeeder
```
## モデルを生成 
```
php artisan make:model Book
```
## DB操作
tinkerによるDB操作
### 起動と終了
```
php artisan tinker
Psy Shell v0.10.4 (PHP 7.4.9 — cli) by Justin Hileman
>>>
>>> exit
Exit:  Goodbye
```
### 全件表示
```
php artisan tinker
Psy Shell v0.10.4 (PHP 7.4.9 — cli) by Justin Hileman
>>> App\Book::all()
=> Illuminate\Database\Eloquent\Collection {#3943
     all: [
       App\Book {#3942
         id: 1,
         title: "Laravel マスターブック",
         author: "白石護",
         publisher: "衆映社",
         price: 2900,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#3536
         id: 2,
         title: "Laravel 逆引き辞典",
         author: "松浦恵一他",
         publisher: "コトブキ出版",
         price: 1980,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#3904
         id: 3,
         title: "みんなのPHP",
         author: "PHPユーザーグループ他",
         publisher: "評論技術社",
         price: 2180,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
     ],
   }
>>>>>> exit
Exit:  Goodbye
```
### 新規登録
#### insertメソッド
```
>>> App\Book::insert(['title' => 'PHP WORK BOOK', 'author'=>'Keiko Takahashi', 'publisher' => 'SANWA BOOKS', 'price' => 1980]);
=> true
>>> App\Book::all()
=> Illuminate\Database\Eloquent\Collection {#4156
     all: [
       App\Book {#4158
         id: 1,
         title: "Laravel マスターブック",
         author: "白石護",
         publisher: "衆映社",
         price: 2900,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4160
         id: 2,
         title: "Laravel 逆引き辞典",
         author: "松浦恵一他",
         publisher: "コトブキ出版",
         price: 1980,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4157
         id: 3,
         title: "みんなのPHP",
         author: "PHPユーザーグループ他",
         publisher: "評論技術社",
         price: 2180,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4155
         id: 4,
         title: "PHP WORK BOOK",
         author: "Keiko Takahashi",
         publisher: "SANWA BOOKS",
         price: 1980,
         created_at: null,
         updated_at: null,
       },
     ],
   }
>>> exit
Exit:  Goodbye
```
#### saveメソッド
```
php artisan tinker
Psy Shell v0.10.4 (PHP 7.4.9 — cli) by Justin Hileman
>>> $book = new \App\Book;
=> App\Book {#3220}
>>> $book -> title = 'PHP 7.2 Master Book';
=> "PHP 7.2 Master Book"
>>> $book -> author = 'Abe Shinzo';
=> "Abe Shinzo"
>>> $book -> publisher = 'Tech Magazine';
=> "Tech Magazine"
>>> $book -> price = 1580;
=> 1580
>>> $book -> created_at = now();
=> Illuminate\Support\Carbon @1600982176 {#3227
     date: 2020-09-25 06:16:16.139900 Asia/Tokyo (+09:00),
   }
>>> $book -> updated_at = now();
=> Illuminate\Support\Carbon @1600982193 {#3223
     date: 2020-09-25 06:16:33.472158 Asia/Tokyo (+09:00),
   }
>>> $book -> save();
=> true
>>> \App\Book::all()
=> Illuminate\Database\Eloquent\Collection {#3905
     all: [
       App\Book {#4152
         id: 1,
         title: "Laravel マスターブック",
         author: "白石護",
         publisher: "衆映社",
         price: 2900,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4153
         id: 2,
         title: "Laravel 逆引き辞典",
         author: "松浦恵一他",
         publisher: "コトブキ出版",
         price: 1980,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4154
         id: 3,
         title: "みんなのPHP",
         author: "PHPユーザーグループ他",
         publisher: "評論技術社",
         price: 2180,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4155
         id: 4,
         title: "PHP WORK BOOK",
         author: "Keiko Takahashi",
         publisher: "SANWA BOOKS",
         price: 1980,
         created_at: null,
         updated_at: null,
       },
       App\Book {#4156
         id: 5,
         title: "PHP 7.2 Master Book",
         author: "Abe Shinzo",
         publisher: "Tech Magazine",
         price: 1580,
         created_at: "2020-09-25 06:16:16",
         updated_at: "2020-09-25 06:16:33",
       },
     ],
   }
>>> exit
Exit:  Goodbye
```
### 更新
#### updateメソッド
```
>>> \App\Book::where('id',4)->update(['title' => 'New PHP WORK BOOK']);
=> 1
>>> \App\Book::all();
=> Illuminate\Database\Eloquent\Collection {#3906
     all: [
       App\Book {#4153
         id: 1,
         title: "Laravel マスターブック",
         author: "白石護",
         publisher: "衆映社",
         price: 2900,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4154
         id: 2,
         title: "Laravel 逆引き辞典",
         author: "松浦恵一他",
         publisher: "コトブキ出版",
         price: 1980,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4155
         id: 3,
         title: "みんなのPHP",
         author: "PHPユーザーグループ他",
         publisher: "評論技術社",
         price: 2180,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4156
         id: 4,
         title: "New PHP WORK BOOK",
         author: "Keiko Takahashi",
         publisher: "SANWA BOOKS",
         price: 1980,
         created_at: "2020-09-25 06:22:22",
         updated_at: "2020-09-25 06:26:40",
       },
       App\Book {#4157
         id: 5,
         title: "PHP 7.2 Master Book",
         author: "Abe Shinzo",
         publisher: "Tech Magazine",
         price: 1580,
         created_at: "2020-09-25 06:16:16",
         updated_at: "2020-09-25 06:16:33",
       },
     ],
   }
>>> exit
Exit:  Goodbye
```
#### saveメソッド
```
>>> $book = \App\Book::where('id',4)->first();
=> App\Book {#4098
     id: 4,
     title: "PHP WORK BOOK",
     author: "Keiko Takahashi",
     publisher: "SANWA BOOKS",
     price: 1980,
     created_at: null,
     updated_at: null,
   }
>>> $book -> created_at = now();
=> Illuminate\Support\Carbon @1600982542 {#3223
     date: 2020-09-25 06:22:22.467834 Asia/Tokyo (+09:00),
   }
>>> $book -> updated_at = now();
=> Illuminate\Support\Carbon @1600982547 {#4097
     date: 2020-09-25 06:22:27.186383 Asia/Tokyo (+09:00),
   }
>>> $book -> save();
=> true
>>> \App\Book::all();
=> Illuminate\Database\Eloquent\Collection {#3536
     all: [
       App\Book {#4152
         id: 1,
         title: "Laravel マスターブック",
         author: "白石護",
         publisher: "衆映社",
         price: 2900,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#3904
         id: 2,
         title: "Laravel 逆引き辞典",
         author: "松浦恵一他",
         publisher: "コトブキ出版",
         price: 1980,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#3942
         id: 3,
         title: "みんなのPHP",
         author: "PHPユーザーグループ他",
         publisher: "評論技術社",
         price: 2180,
         created_at: "2020-09-24 23:50:37",
         updated_at: "2020-09-24 23:50:37",
       },
       App\Book {#4158
         id: 4,
         title: "PHP WORK BOOK",
         author: "Keiko Takahashi",
         publisher: "SANWA BOOKS",
         price: 1980,
         created_at: "2020-09-25 06:22:22",
         updated_at: "2020-09-25 06:22:27",
       },
       App\Book {#4159
         id: 5,
         title: "PHP 7.2 Master Book",
         author: "Abe Shinzo",
         publisher: "Tech Magazine",
         price: 1580,
         created_at: "2020-09-25 06:16:16",
         updated_at: "2020-09-25 06:16:33",
       },
     ],
   }
>>> exit
Exit:  Goodbye
```
## ルーティング
### 一覧表示(get) 
```app/Http\Controllers\BookController.php
public function show(){
        $books = Book::all();
        $context = ['books' => $books];
        return view('books/show', $context);
    }
```
```resurces/views/show.blade.php
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
          @foreach($books as $book)
          <tr>
              <td>{{$book->id}}</td>
              <td>{{$book->title}}</td>
              <td>{{$book->publisher}}</td>
              <td>{{$book->author}}</td>
              <td>{{$book->price}}</td>
          </tr>
          @endforeach
      </table>
@endsection
```
### 新規登録(get)
登録フォームを表示
```web.php
Route::get('/create', 'BookController@create');
```
```BookController.php
public function create(){
    return view('books/createbook');
}
```
### 新規登録(post)
```web.php
Route::post('/create', 'BookController@store');
```
登録処理後、一覧画面にリダイレクト
```BookController.php
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
```
### validation
#### Controllerにバリデーションを追加
```BookController.php
//use追加
use Validator;
```

```BookController.php
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

```create.blade.php
{{-- error start--}}
@if(count($errors))
    <ul>
    @foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
    @endforeach
    </ul>
@endif
{{-- error end--}}
<input type="text" name="title" id="" value="{{old('title')}}">
```
#### 日本語化
https://github.com/minoryorg/validation.php  
/resources/ja/を作成し配置  
```app.php
  'locale' => 'ja',
```
```validation.php
 'attributes' => [
        'title'=>'書籍名',
        'author'=>'著者',
        'price'=>'価格',
    ],
```
### 更新処理(get)
更新フォームを表示(登録画面を再利用)
```web.php
Route::get('/edit{id}', 'BookController@edit');
Route::post('/edit{id}', 'BookController@update');
```

### 更新処理(post)
登録処理後、一覧画面にリダイレクト
### 削除処理(get)
確認画面を表示
### 削除処理(post)
削除処理後、一覧画面にリダイレクト
