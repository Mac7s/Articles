<?php
namespace App\Services;

use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleService{

    public function getArticleOfIndexPage(){
        $best_articles =Article::inRandomOrder()->take(6)->get();
        $last_articles =Article::inRandomOrder()->take(6)->get();
        $articles = Article::paginate(4);
        return
            [
                "total"=> $articles->total(),
                "per_page"=> $articles->perPage(),
                "current_page"=> $articles->currentPage(),
                "last_page"=> $articles->lastPage(),
                "first_page_url"=> "http://127.0.0.1:8000/api/v1",
                "last_page_url"=> "http://127.0.0.1:8000/api/v1?page=".$articles->lastPage(),
                "next_page_url"=> $articles->nextPageUrl(),
                "prev_page_url"=> $articles->previousPageUrl(),
                "from"=> 1,
                "to"=> $articles->lastPage(),

                'data'=>[
                    'best_articles' => ArticleResource::collection($best_articles),
                    'last_articles' => ArticleResource::collection($last_articles),
                    'articles' => ArticleResource::collection($articles)
                ],
            ];
    }

}
