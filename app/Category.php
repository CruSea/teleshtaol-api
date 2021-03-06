<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $hidden = ['created_at', 'updated_at'];
    
    public function articles() {
        return $this->hasMany('App\Article');
    }
}
