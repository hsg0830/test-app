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

        // パターン１：when()を使う

//        return Article::with('category')
//            ->when($request->categoryNo, function($query, $category_id){
//
//                $query->where('category_id', $category_id);
//
//            })
//            ->paginate(6);


        // パターン２：query() を使う

        $query = Article::query();
        $category_id = intval($request->categoryNo);

        if($category_id > 0) {

            $query->where('category_id', $category_id);

        }

        return $query
            ->with('category')
            ->paginate(6);

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
