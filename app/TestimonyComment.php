<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestimonyComment extends Model
{
    protected $table = 'testimony_comments';

    public function Testimony()
    {
        return $this->belongsTo('App\Testimony');
    }
    public function testimonies(){
        return $this->hasOne('App\testimony');
    }

   
}
