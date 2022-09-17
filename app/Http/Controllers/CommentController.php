<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request,Article $article){
        (new CommentService($article,$request->all()))->createComment();
        return response()->json([
            'message'=>'comment created successfully'
        ]);
    }

    public function update(UpdateCommentRequest $request ,Article $article ,Comment $comment){
        $comment->update($request->all());
        return response()->json([
            'message'=>'comment updated successfully successfully'
        ]);
    }

    public function destroy(Article $article,Comment $comment){
        $comment->delete();
        return response()->json([
            'message'=>'comment deleted successfully'
        ]);
    }

}
