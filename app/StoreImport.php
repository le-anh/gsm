<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreImport extends Model
{
    protected $table = 'storeimport';

    public function caytrong()
    {
    	return $this->belongsTo('App\CayTrong', 'caytrong_id');
    }

    public function vusanxuat()
    {
    	return $this->belongsTo('App\VuSanXuat', 'vusanxuat_id');
    }

    public function storeimportdetail()
    {
    	return $this->hasMany('App\StoreImportDetail', 'storeimport_id');
    }
}
