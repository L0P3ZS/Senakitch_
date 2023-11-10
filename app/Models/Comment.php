<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;
     
    protected $guarded = [];
    //especificacion que es una tabla (1:N) polimorfica
    public function commentable(){
        return $this->morphTo();
    }
    
     //relacion uno a muchos inversa
    public function user(){
        return$this->belongsTo('App\Models\User');
    }
}
