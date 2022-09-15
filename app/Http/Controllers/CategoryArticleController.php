<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryArticleController extends Controller
{
    public function index(Category $category , Request $request){
        $articles = $category
                        ->articles()
                        ->filter($request->all())
                        ->paginate(5);
        return ArticleResource::collection($articles);
    }
}
