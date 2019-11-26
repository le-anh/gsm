<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChungLoai extends Model
{
    protected $table = 'chungloai';

    public function caytrong()
    {
    	return $this->belongsTo('App\CayTrong', 'caytrong_id');
    }
}
