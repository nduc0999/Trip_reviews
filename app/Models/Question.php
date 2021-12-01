<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $guarded = [];

    public function Answer(){
        return $this->hasMany(Answer::class,'id_question');
    }
}
