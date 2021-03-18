<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;

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
    // ファイル保存
    if ($request->hasFile('media')) {
      $path = $request->media->store('public/medias');
    } else {
      return ['result' => false];
    }
    // $fullPath = asset($path);
    // echo asset('storage/file.txt');
    // dd($path);

    $media = new Media;
    $media->type = $request->type;
    $media->memo = $request->memo;
    $media->path = $path;
    // $media->path = $fullPath;
    $result = $media->save();

    return ['result' => $result];
  }
}