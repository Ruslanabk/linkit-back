<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['route','url','user_id','description'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
