<?php
namespace App\Services;

use App\Models\Article;

class CommentService{

    public function __construct(public Article $article,public array $data)
    {

    }

    public function createComment(){

        $data = array_merge($this->data,[
            'user_id'=>auth()->id()
        ]);
        $this->article->comments()->create($data);

    }


}

