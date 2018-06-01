<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class Article extends Model
{

    
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    public function categories(){
        return $this->hasOne('App\Category');
    }
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
    public function likes()
{
    return $this->belongsToMany('App\User', 'likes');
}
    // public function comments()
    // {
    //     return $this->hasMany('App\Comment');
        
    // }
public function user () {
    return $this->belongsTo('App\User', 'user_id');
}
}
