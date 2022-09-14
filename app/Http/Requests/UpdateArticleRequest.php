<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends StoreArticleRequest
{
    public function authorize()
    {

        $article = $this->route('article');
        return  $this->user()->can('update', $article);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(parent::rules(),[
            'slug'=>['required','', Rule::unique('articles')->ignore($this->article->slug, 'slug')]
        ]);
    }
}
