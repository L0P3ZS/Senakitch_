<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $guarded =[];

    //relaciion uno amuchos inversa
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
      //RELACION UNO A MUCHOS PLIMORFICA
      public function comments(){
        return $this->morphMany('App\Models\Comment','commentable');
    }


}
