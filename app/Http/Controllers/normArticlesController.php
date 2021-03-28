<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\normArticle;
use App\Models\normSubContent;
use App\Models\Category;

class normArticlesController extends Controller
{
  public function categories()
  {
    $categories = Category::all();

    return $categories;
  }

  public function create()
  {
    return view('norms.create');
  }

  public function store(Request $request)
  {
    // Validation
    $request->validate([
      'subContents' => ['required'],
      'subContents.*.no' => ['required', 'integer', 'min:0'],
      'subContents.*.title' => ['required', 'string', 'max:50'],
      'subContents.*.norm_article_id' => ['required', 'exists:norm_article,id'],
      'subContents.*.description' => ['required', 'string'],
    ]);

    $result = false;

    DB::beginTransaction(); // トランザクションを開始

    try {

      $normArticle = new normArticle();
      $normArticle->title = $request->title;
      $normArticle->category_id = $request->category;
      $normArticle->introduction = $request->introduction;
      $normArticle->save();

      if (count($request->subContents) > 0) {
        foreach ($request->subContents as $requestSubContent) {
          $subContent = new normSubContent();
          $subContent->no = $requestSubContent['no'];
          $subContent->title = $requestSubContent['title'];
          $subContent->norm_article_id = $normArticle->id;
          $subContent->description = $requestSubContent['description'];
          $subContent->save();
        }
      }

      DB::commit(); // トランザクション終了： ここで実際にDBへ反映する
      $result = true;
    } catch (\Exception $e) {

      DB::rollBack(); // トランザクション終了： ここまでのDB変更をなかったことにする
      //          dd($e->getMessage()); // 例外の内容が表示されます

    }

    return ['result' => $result];
  }

  public function show(normArticle $normArticle)
  {
    return view('norms.show', [
      'article' => $normArticle,
    ]);
  }
}