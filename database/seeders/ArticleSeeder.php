<?php

namespace Database\Seeders;
use App\Models\Article;  //※追加

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {

            $article = new Article();
            $article->title = 'テストタイトル - ' . $i;
            $article->description = "テスト内容\nテスト内容\nテスト内容\nテスト内容 - " . $i;
            $article->category_id = rand(1, 4);
            $article->save();
        }
    }
}
