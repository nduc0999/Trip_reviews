<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $guarded = [];

    public function Review(){
        return $this->belongsTo(Review::class,'id_review');
    }

    public function Question(){
        return $this->belongsTo(Question::class,'id_question');
    }
}
