<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use Illuminate\Support\Str;

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

        $type = $types[rand(0, 1)];
        $extension = ($type === 'image')
            ? '.jpg'
            : '.mp4';

        $media = new Media();
        $media->type = $type;
        $media->filename = Str::random() . $extension;
        $media->memo = $i . '個目のファイル';
        $media->save();
    }
  }
}
