<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        return view('article.index');
    }

    public function paginate(Request $request) {

      if ($request->categoryNo == 0) {
        return Article::paginate(6);
      } else {
        return Article::where('category_id', $request->categoryNo)->paginate(6);
      }
    }

    public function create() {
        return view('article.create');
    }

    public function show(Article $article) {

        return view('article.show')->with([
            'article' => $article
        ]);
    }

    public function store(Request $request)
    {
        // バリデーションは省略してます
        $article = new Article();
        $article->title = $request->title;
        $article->description = $request->description;
        $article->category_id = $request->category;
        $result = $article->save();

        return ['result' => $result];
    }
}