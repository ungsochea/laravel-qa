<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        $this->hasMany(Answer::class);
    }

    public function setTitleAttribute($vale){
        $this->attributes['title'] = $vale;
        $this->attributes['slug'] = str_slug($vale);
    }

    public function getUrlAttribute(){
        return route("questions.show",$this->slug);
    }

    public function getCreatedDateAtAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count >0 ){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }
}
