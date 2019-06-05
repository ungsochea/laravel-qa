<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body'];

    public function user(){
        return $this->belongTo(User::class);
    }

    public function setTitleAttribute($vale){
        $this->attributes['title'] = $vale;
        $this->attributes['slug'] = str_slug($vale);
    }

}
