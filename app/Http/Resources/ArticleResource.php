<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->title,
            'slug'=>$this->slug,
            'shortDescription'=>$this->shortDescription,
            'longDescripiton'=>$this->full_desciption,
            'author'=>$this->user->only('name','email'),
            'created_at'=>$this->created_at
        ];
    }
}
