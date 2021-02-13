<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kavling extends Model
{
    //
    protected $table = 'kavlings';
    
    public function transaksi(){
        return $this->belongsTo('App\Models\Transaksi');
    }
}
