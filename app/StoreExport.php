<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreExport extends Model
{
    protected $table = 'storeexport';

    public function caytrong()
    {
    	return $this->belongsTo('App\CayTrong', 'caytrong_id');
    }

    public function vusanxuat()
    {
    	return $this->belongsTo('App\VuSanXuat', 'vusanxuat_id');
    }

    public function storeexportdetail()
    {
    	return $this->hasMany('App\StoreExportDetail', 'storeexport_id');
    }
}
