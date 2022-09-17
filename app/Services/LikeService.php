<?php
namespace App\Services;

use App\Models\Article;

class LikeService
{

    public function __construct(public Article $article)
    {

    }

    public function likeArticle()
    {
            if($this->DeleteIfLikedBefore(1)) return;
            $this->article->like()->create([
                'user_id'=>auth()->id(),
                'vote'=>1
            ]);

    }

    public function disLikeArticle()
    {
            if($this->DeleteIfLikedBefore(-1)) return;
            $this->article->like()->create([
                'user_id'=>auth()->id(),
                'vote'=>-1
            ]);
    }


    private function DeleteIfLikedBefore(int $vote){
        $liked_before = $this->article->like()->where('user_id', auth()->id)->where('vote', $vote)->first();
        if($liked_before){
            $liked_before->delete();
            return true;
        }
        return false;
    }

}


