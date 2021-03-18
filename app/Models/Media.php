<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $appends = ['url'];

    use HasFactory;

    // Accessor
    public function getPathAttribute() {

//        $path = $media->path;
        return storage_path('app/public/medias/'. $this->filename);

    }

    public function getUrlAttribute() {

//        $url = $media->url;
        return url('storage/medias/'. $this->filename);

    }

    public function getHeadlineAttribute() {

//        $url = $media->headline;
        return mb_strimwidth($this->description, 0, 50, '...');

    }
}


