<?php

namespace App\Http\Controllers;

use App\StoreImportDetail;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\StoreImport;


class StoreImportDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StoreImportDetail  $storeImportDetail
     * @return \Illuminate\Http\Response
     */
    public function show(StoreImportDetail $storeImportDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreImportDetail  $storeImportDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreImportDetail $storeImportDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreImportDetail  $storeImportDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreImportDetail $storeImportDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreImportDetail  $storeImportDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreImportDetail $storeImportDetail)
    {
        //
    }

    // Function my define
    public function getMaLo()
    {
        // return StoreImportDetail::all()->select('malo');
        $DS_StoreImportDetail = StoreImportDetail::select('malo')->get();
        $arrayStoreImportDetail = array();
        foreach ($DS_StoreImportDetail as $key => $value) {
            array_push($arrayStoreImportDetail, $value->malo);
        }
        return $arrayStoreImportDetail;
    }

    public static function getMaPhieuNhap($maLo)
    {
        $DS_StoreImportDetail = StoreImportDetail::where('malo', '=', $maLo)
            -> join('storeimport', 'storeimport.id', '=', 'storeimportdetail.storeimport_id')
            -> select('storeimportdetail.id', 'storeimport.manhapkho')
            ->groupBy('storeimportdetail.id')
            ->get();

        return $DS_StoreImportDetail;
    }

    public function getMaGiongInfo($storeImportDetailID)
    {
        // return StoreImportDetail::all()->select('malo');
        $StoreImportDetail = StoreImportDetail::find($storeImportDetailID)
            // ->leftjoin('chungloai', 'chungloai.id', '=', 'storeimportdetail.chungloai_id')
            ->leftjoin('storeimport', 'storeimport.id', '=', 'storeimportdetail.storeimport_id')
            ->leftjoin('phancapgiong', 'phancapgiong.id', '=', 'storeimportdetail.phancapgiong_id')
            ->select('storeimportdetail.*', 'phancapgiong.tenphancapgiong', 'storeimport.manhapkho')
            ->first(); //->toArray();
        // if($StoreImportDetail)
        // {
        //     $StoreImportDetail = $StoreImportDetail->toArray();
        // }
        
        return $StoreImportDetail;
    }

    public static function destroyByID($idStoreImportDetail)
    {
        // if(Auth::check())// Kiểm tra quyền xóa.
        // {
            try {
                StoreImportDetail::destroy($idStoreImportDetail);
                return true;
            } catch (Exception $e) {
                return false;
            }
            
        // }
    }
    // End Function my define
}
