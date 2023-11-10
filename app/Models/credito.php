<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class credito extends Model
{
    use HasFactory;

    public function pago(){
        return $this->belongsTo('App\Models\Pagos');
    }
}
