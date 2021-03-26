<?php

namespace App\Http\Controllers;

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

    return ['result' => true];
  }

  public function show(normArticle $normArticle)
  {
    return view('norms.show', [
      'article' => $normArticle,
    ]);
  }
}