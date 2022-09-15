<?php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ArticleFilter{

    protected $allowed_functions=[
        'q',
        'auther',
        'sort_by'
    ];

    public function __construct(public Builder $query)
    {

    }


    public function apply(array $params){
        foreach($params as $method_name=>$value){
            if(!in_array($method_name,$this->allowed_functions)) continue;
            if($value==null) continue;
            $this->$method_name($value);
        }
    }

    private function q($value){
        return $this->query->where('full_description','like',"%$value%");
    }
    private function auther($value){
      $this->query=  $this->query->join('users', function ($join) {
        $join->on('users.id', '=', 'articles.user_id');
    })
    ->where('users.name','=',$value)
    ->select([DB::raw(' articles.* ')]);
 
    }
    private function sortBy($value){
        return $this->query->orderBy($value,'desc');
    }

}



