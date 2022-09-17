<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\LikeService;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function addLike(Article $article){
        (new LikeService($article))->likeArticle();
    }

    public function addDislike(Article $article){
       (new LikeService($article))->disLikeArticle();
    }
}
