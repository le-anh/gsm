<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThoiGianTrongRa extends Model
{
    protected $table = 'thoigiantrongra';

    protected $fillable = [
        'caytrong_id', 'sothang',
    ];
}
