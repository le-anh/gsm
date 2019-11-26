<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreExportDetail extends Model
{
    protected $table = 'storeexportdetail';

    public function storeexort()
    {
    	return $this->belongsTo('App\StoreExport', 'storeexport_id');
    }

    public function chungloai()
    {
    	return $this->belongsTo('App\ChungLoai', 'chungloai_id');
    }

    public function phancapgiong()
    {
    	return $this->belongsTo('App\PhanCapGiong', 'phancapgiong_id');
    }
}
