<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kavling()
    {
        return $this->belongsTo('App\Models\Kavling');
    }

    public function tagihan()
    {
        return $this->hasMany('App\Models\Tagihan', 'transaksi_id');
    }
}
