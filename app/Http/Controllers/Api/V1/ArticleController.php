<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteArticleRequest;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        return (new ArticleService)->getArticleOfIndexPage();
    }
    public function show(Article $article){
        return (new ArticleResource($article));
    }
    public function store(StoreArticleRequest $request){
        $request->user()->articles()->create($request->all());
        return response()->json([
            'message'=>'article created successfully'
        ]);
    }
    public function update(Article $article,UpdateArticleRequest $request){
        $article->update($request->all());
        return response()->json([
            'message'=>'article updated successfully'
        ]);
    }
    public function destory(Article $article,DeleteArticleRequest $request){
        $article->delete();
        return response()->json([
            'message'=>'article deleted successfully'
        ]);
    }
}
