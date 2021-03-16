<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $types = ["image", "video"];

    for ($i = 0; $i < 5; $i++) {
      $media = new Media();
      $media->type = $types[rand(0, 1)];
      $media->path = 'http://test.com/' . $i;
      $media->memo = $i . '個目のファイル';
      $media->save();
    }
  }
}