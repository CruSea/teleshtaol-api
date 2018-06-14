<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
   protected $table = 'testimonies';
   protected $fillable = ['title' , 'body' , 'approval' , 'user_id'];


   public function testimonies() {
    return $this->hasMany('App\TestimonyComment');
 }
 public function user () {
    return $this->belongsTo('App\User', 'user_id');
}
}


