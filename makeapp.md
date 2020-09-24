# 簡単な蔵書アプリケーションをLaravelで作成

## ページレイアウト
投稿画面、一覧画面を作成
/resourses/view/books内にxxx.blade.htmlで作成  
*表示確認後拡張子をphpに修正

## ルーティング(1)
一覧表示(get)   
登録(get)   
テンプレートでリンクの確認  

## ルーティング(2)
controllerにまとめる  

```
php .\artisan make:controller BookController
```

## テンプレート化
基本テンプレートをlayout.blade.phpにまとめる  
@extends('ディレクトリ.テンプレート名の拡張子不要')の書式に注意

## データベース設定
### DBを作成 

``` MySQL Monitor
create database laravel default charset utf8mb4;
create user 'lara'@'localhost' identified by 'abcd';
grant all on laravel_demo.* to 'lara'@'localhost';
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

### migration
```
php artisan migrate
```
### 初期データの投入
tinkerによるDB操作
seederによる初期データの投入


## モデルを生成 


## ルーティング
一覧表示(get) 
登録(post) 




