<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihans';

    public function transaksi()
    {
        return $this->hasOne('App\Models\Transaksi');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
