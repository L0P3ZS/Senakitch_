<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'value_pay',
        'pay_day'
    ];

    public function creditos(){
        return $this->hasMany('App\Models\credito');
    }
}
