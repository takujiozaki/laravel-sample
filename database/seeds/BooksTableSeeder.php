<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
}
