<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($vale){
        $this->attributes['title'] = $vale;
        $this->attributes['slug'] = str_slug($vale);
    }

    public function getUrlAttribute(){
        return route("questions.show",$this->id);
    }

    public function getCreatedDateAtAttribute(){
        return $this->created_at->diffForHumans();
    }

}
