<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
