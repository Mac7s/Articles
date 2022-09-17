<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Smsverify extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone'
    ];
    public function existNumberInDatabase($phone){
        return $this::where('phone',$phone)->first();
    }
    

}
