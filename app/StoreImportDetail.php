<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreImportDetail extends Model
{
    protected $table = 'storeimportdetail';

    public function storeimport()
    {
    	return $this->belongsTo('App\StoreImport', 'storeimport_id');
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
