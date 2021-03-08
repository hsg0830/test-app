<?php

namespace Database\Seeders;

use App\Models\Category;  //※追加
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["맞춤법", "발음법", "띄여쓰기", "기타"];

        for ($i = 0; $i < count($categories); $i++) {
            $category = new Category();
            $category->name = $categories[$i];
            $category->save();
        }
    }
}
