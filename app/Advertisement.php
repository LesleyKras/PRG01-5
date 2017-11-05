<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

    class Advertisement extends Model
    {
        protected $fillable = ['title','description', 'price'];

        public function likes(){
            return $this->hasMany('App\Like');
        }

        public function categorys(){
            return $this->belongsToMany('App\Category')->withTimestamps();
        }

        public function user(){
            return $this->belongsTo('App\User');
        }


    }