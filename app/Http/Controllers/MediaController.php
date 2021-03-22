<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Validation\Rule;

class MediaController extends Controller
{
  function index()
  {
    return view('medias.index');
  }

  function list()
  {
    return Media::get();
  }

  function store(Request $request)
  {
    // dd($request);

    $request->validate([
      'type' => ['required', Rule::in('image', 'video')],
      'media' => ($request->type === 'image')
        ? ['required', 'image', 'max:5000'] // max 5 MB
        : ['required', 'mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi', 'max:50000000'] //50MB
    ]);

    $result = false;

    if ($request->hasFile('media')) {

      $path = $request->media->store('public/medias');
      $filename = basename($path);

      $media = new Media;
      $media->type = $request->type;
      $media->memo = $request->memo;
      $media->filename = $filename;
      $result = $media->save();
    }

    return ['result' => $result];
  }

  //    public function test() { // 不要：テスト
  //
  //        $media = Media::first();
  //        echo $media->id;
  //        echo $media->memo;
  //        echo $media->path;
  //        echo $media->url;
  //
  //    }
}