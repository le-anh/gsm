<?php

namespace App\Http\Controllers;

use App\StoreExportDetail;
use Illuminate\Http\Request;
use App\StoreImport;

class StoreExportDetailController extends Controller
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
     * @param  \App\StoreExportDetail  $storeExportDetail
     * @return \Illuminate\Http\Response
     */
    public function show(StoreExportDetail $storeExportDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreExportDetail  $storeExportDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreExportDetail $storeExportDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreExportDetail  $storeExportDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreExportDetail $storeExportDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreExportDetail  $storeExportDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreExportDetail $storeExportDetail)
    {
        //
    }

    // Function my define
    /**
     * Remove the specified resource from storage.
     *
     * @param  $idStoreExportDetail
     * @return bool
     */
    public static function destroyByID($idStoreExportDetail)
    {
        // if(Auth::check())// Kiểm tra quyền xóa.
        // {
            try {
                StoreExportDetail::destroy($idStoreExportDetail);
                return true;
            } catch (Exception $e) {
                return false;
            }
            
        // }
    }

    public function getPhieuXuat($storeImportID)
    {
        $storeExport =  StoreImport::find($storeImportID);

        if($storeExport)
        {
            return StoreImport::where('storeimport.id', '=', $storeImportID)
            -> join('storeimportdetail', 'storeimportdetail.storeimport_id', '=', 'storeimport.id' )
            -> join('storeexportdetail', 'storeexportdetail.storeimportdetail_id', 'storeimportdetail.id')
            -> select('storeexportdetail.id')
            -> groupBy('storeexportdetail.id')
            -> first();
        }
        else
        {
            return "";
        }
    }
    // End Function my define
}
