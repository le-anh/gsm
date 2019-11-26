<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CayTrong extends Model
{
    protected $table = 'caytrong';

    public function chungloai()
    {
    	return $this->hasMany('App\ChungLoai', 'caytrong_id');
    }

    public function thoigiantrongra()
    {
        return $this->hasOne('App\ThoiGianTrongRa', 'caytrong_id');
    }
}
