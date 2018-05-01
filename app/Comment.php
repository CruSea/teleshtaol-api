<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'article_comments';

    public function articles(){
        return $this->hasOne('App\Article');
    }

    public function Article()
    {
        return $this->belongsTo('App\Article');
    }

}
