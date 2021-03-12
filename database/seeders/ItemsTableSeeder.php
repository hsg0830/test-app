<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i = 1 ; $i <= 100 ; $i++) {

        Item::create([
            'name' => $i .'番目の商品名'
        ]);
      }
    }
}