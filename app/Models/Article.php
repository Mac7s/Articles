<?php

namespace App\Models;

use App\Filters\ArticleFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'shortDescription',
        'full_description',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeFilter($query,array $params){
        (new ArticleFilter($query))->apply($params);
    }

}
