<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreImportDetail;
use DB;

class StoreStatisticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countSeed = StoreInventoryController::CountSeed();
        $countSeedExist = StoreInventoryController::CountSeedExistInStore();

        $totalSeedImport = StoreInventoryController::QuatitySeedImport();
        $totalSeedExport = StoreInventoryController::QuatyitySeedExport();

        $DS_NhapKhoChiTiet = StoreImportDetail::select('malo', DB::raw('sum(luong) as luong'))->groupBy('malo')->get();

        // print_r(count($DS_NhapKhoChiTiet));

        
        return view('backend.storemanagement.storestatisticaldata', [
            'countSeed' => $countSeed,
            'countSeedExist' => $countSeedExist,
            'totalSeedImport' => $totalSeedImport,
            'totalSeedExport' => $totalSeedExport,
            'DS_NhapKhoChiTiet' => $DS_NhapKhoChiTiet
        ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
