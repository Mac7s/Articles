<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(6)->create();
        $this->addRandomCategoryToArticle();
    }

    private function getArticles(){
        return Article::all();
    }


    private function addRandomCategoryToArticle(){
        $articles = $this->getArticles();
        for($i=1;$i<=$articles->count();$i++){
            $this->eachArticleHasThreeCategory($i);
        }
    }


    private function getRandomCategoryId(){
        return rand(1,count(Category::all()));
    }

    private function eachArticleHasThreeCategory(int $article_id){
        for($j=0;$j<3;$j++){
            DB::table('article_category')->insert([
                'category_id'=>$this->getRandomCategoryId(),
                'article_id'=>$article_id
            ]);
        }
    }
}

