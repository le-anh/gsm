<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StoreImport;
use App\StoreImportDetail;
use App\StoreExportDetail;
use DB;

class StoreInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countSeed = $this::CountSeed();
        $countSeedExist = $this::CountSeedExistInStore();

        $totalSeedImport = $this::QuatitySeedImport();
        $totalSeedExport = $this::QuatyitySeedExport();

        $DS_NhapKhoChiTiet = StoreImportDetail::all();

        
        return view('backend.storemanagement.storeinventory', [
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

    // Function my define
     /**
     * CountSeed (Đếm số giống trong ngân hàng [Tổng số giống đã nhập kho])
     *
     * @param  null
     * @return int count
     */
    public static function CountSeed()
    {
        return count(StoreImportDetail::select('tendonggiong')->groupBy('tendonggiong')->get());
    }

     /**
     * CountSeedExistInStore (Đếm số giống còn trong kho [hiện đang có trong kho])
     *
     * @param  null
     * @return int count
     */
    public static function CountSeedExistInStore()    
    {
        $staticalSeed =  StoreImportDetail::select('tendonggiong', DB::raw('SUM(luong) as tongluongton'))->groupBy('tendonggiong')->get();

        if($staticalSeed)
        {
            foreach ($staticalSeed as $key => $value) {
                $staticalSeedExport =  StoreExportDetail::where('tendonggiong', '=', $value->tendonggiong)
                    -> select('tendonggiong', DB::raw('SUM(luongthatxuat) as tongluongxuat'))->groupBy('tendonggiong')->first();
                if($staticalSeedExport)
                {
                    $value->tongluongton -= $staticalSeedExport->tongluongxuat;
                }
                if($value->tongluongton <= 0)
                {
                    unset($staticalSeed[$key]);
                }
            }
        }

        return count($staticalSeed);
    }

    /**
     * QuatitySeedImport (Tính tổng lượng đã nhập kho)
     * 
     * @param  null
     * @return int totalSeedImport
     */
    public static function QuatitySeedImport()
    {
        $totalSeedImport = intval(StoreImportDetail::select(DB::raw('SUM(luong) as tongluongnhap'))->first()->tongluongnhap);

        return $totalSeedImport;
    }

    /**
     * QuatyitySeedExport (Tính tổng lượng đã xuất kho)
     *
     * @param  null
     * @return int totalSeedImport
     */
    public static function QuatyitySeedExport()
    {
        $totalSeedExport = intval(StoreExportDetail::select(DB::raw('SUM(luongthatxuat) as tongluongxuat'))->first()->tongluongxuat);
        return $totalSeedExport;
    }

    /**
     * QuatyitySeedExportByMaGiong (Tính tổng lượng đã xuất kho của mã giống (mã lô))
     *
     * @param  $maGiong
     * @return int totalSeedImport
     */
    public static function QuatyitySeedExportByMaGiong($maGiong)
    {
        $totalSeedExport = intval(StoreExportDetail::where('malo', '=', $maGiong)
            -> select(DB::raw('SUM(luongthatxuat) as tongluongxuat'))->first()->tongluongxuat);
        if($totalSeedExport)
        {
            return $totalSeedExport;
        }
        else
        {
            return 0;
        }
    }

    /**
     * QuatyitySeedExportByStoreImportDetailID (Tính tổng lượng đã xuất kho của mã giống theo mã chi tiết nhập)
     *
     * @param  $storeImportDetailID
     * @return int totalSeedImport
     */
    public static function QuatyitySeedExportByStoreImportDetailID($storeImportDetailID)
    {
        $totalSeedExport = intval(StoreExportDetail::where('storeimportdetail_id', '=', $storeImportDetailID)
            -> select(DB::raw('SUM(luongthatxuat) as tongluongxuat'))->first()->tongluongxuat);
        if($totalSeedExport)
        {
            return $totalSeedExport;
        }
        else
        {
            return 0;
        }
    }

    /**
     * QuatyitySeedExportByMaGiong (Tính tổng lượng đã xuất kho của mã giống (mã lô))
     *
     * @param  date $tuNgay, $denNgay
     * @return arry -> object arrayStoreImportDetail
     */
    public static function InventorySeedByDate($tuNgay, $denNgay)
    {
        $storeImportDetail = StoreImport::where('ngaynhapkho', '>=', $tuNgay)
            -> where('ngaynhapkho', '<=', $denNgay)
            -> join('storeimportdetail', 'storeimportdetail.storeimport_id', '=', 'storeimport.id')
            -> leftjoin('phancapgiong', 'phancapgiong.id', '=', 'storeimportdetail.phancapgiong_id')
            -> select('storeimportdetail.*', 'phancapgiong.tenphancapgiong', 'storeimport.manhapkho')
            -> get()->toArray();

        $arrayStoreImportDetail = array();

        // Lấy tổng lượng xuất => lượng tồn
        foreach ($storeImportDetail as $key => $value) {

            $luongXuat = StoreInventoryController::QuatyitySeedExportByStoreImportDetailID($value['id']);
            
            array_push($value, $luongXuat);
            array_push($value, ($value['luong'] - $luongXuat));

            $value['tongluongxuat'] = $value['0'];
            unset($value['0']);
            
            $value['tongluongton'] = $value['1'];
            unset($value['1']);
            
            array_push($arrayStoreImportDetail, $value);
            
        }

        return $arrayStoreImportDetail;
    }

    /**
     * QuatyitySeedExportByMaGiong (Tính tổng lượng đã xuất kho của mã giống (mã lô))
     *
     * @param  string $tenDongGiong
     * @return arry -> object arrayStoreImportDetail
     */
    public static function InventorySeedBySeedType($tenDongGiong)
    {
        $storeImportDetail = StoreImportDetail::where('tendonggiong', 'like', '%' . $tenDongGiong . '%')
            -> leftjoin('phancapgiong', 'phancapgiong.id', '=', 'storeimportdetail.phancapgiong_id')
            -> leftjoin('storeimport', 'storeimport.id', '=', 'storeimportdetail.storeimport_id')
            -> select('storeimportdetail.*', 'phancapgiong.tenphancapgiong', 'storeimport.manhapkho')
            -> get()->toArray();

        $arrayStoreImportDetail = array();

        // Lấy tổng lượng xuất => lượng tồn
        foreach ($storeImportDetail as $key => $value) {

            $luongXuat = StoreInventoryController::QuatyitySeedExportByStoreImportDetailID($value['id']);
            
            array_push($value, $luongXuat);
            array_push($value, ($value['luong'] - $luongXuat));

            $value['tongluongxuat'] = $value['0'];
            unset($value['0']);
            
            $value['tongluongton'] = $value['1'];
            unset($value['1']);
            
            array_push($arrayStoreImportDetail, $value);
            
        }

        return $arrayStoreImportDetail;
    }

    /**
     * QuatyitySeedExportByMaGiong (Tính tổng lượng đã xuất kho của mã giống (mã lô))
     *
     * @param  string $maGiong
     * @return arry -> object arrayStoreImportDetail
     */
    public static function InventorySeedBySeedID($maGiong)
    {
        $storeImportDetail = StoreImportDetail::where('malo', '=', $maGiong)
            -> leftjoin('phancapgiong', 'phancapgiong.id', '=', 'storeimportdetail.phancapgiong_id')
            -> leftjoin('storeimport', 'storeimport.id', '=', 'storeimportdetail.storeimport_id')
            -> select('storeimportdetail.*', 'phancapgiong.tenphancapgiong', 'storeimport.manhapkho')
            -> get()->toArray();

        $arrayStoreImportDetail = array();

        // Lấy tổng lượng xuất => lượng tồn
        foreach ($storeImportDetail as $key => $value) {

            $luongXuat = StoreInventoryController::QuatyitySeedExportByStoreImportDetailID($value['id']);
            
            array_push($value, $luongXuat);
            array_push($value, ($value['luong'] - $luongXuat));

            $value['tongluongxuat'] = $value['0'];
            unset($value['0']);
            
            $value['tongluongton'] = $value['1'];
            unset($value['1']);
            
            array_push($arrayStoreImportDetail, $value);
            
        }

        return $arrayStoreImportDetail;
    }

    /**
     * QuatyitySeedExportByMaGiong (Tính tổng lượng đã xuất kho của mã giống (mã lô))
     *
     * @param  string $maNhapKho
     * @return arry -> object arrayStoreImportDetail
     */
    public static function InventorySeedByStoreImportID($maNhapKho)
    {
        $storeImportDetail = StoreImport::where('manhapkho', '=', $maNhapKho)
            -> join('storeimportdetail', 'storeimportdetail.storeimport_id', '=', 'storeimport.id')
            -> leftjoin('phancapgiong', 'phancapgiong.id', '=', 'storeimportdetail.phancapgiong_id')
            -> select('storeimportdetail.*', 'phancapgiong.tenphancapgiong', 'storeimport.manhapkho')
            -> get()->toArray();

        $arrayStoreImportDetail = array();

        // Lấy tổng lượng xuất => lượng tồn
        foreach ($storeImportDetail as $key => $value) {

            $luongXuat = StoreInventoryController::QuatyitySeedExportByStoreImportDetailID($value['id']);
            
            array_push($value, $luongXuat);
            array_push($value, ($value['luong'] - $luongXuat));

            $value['tongluongxuat'] = $value['0'];
            unset($value['0']);
            
            $value['tongluongton'] = $value['1'];
            unset($value['1']);
            
            array_push($arrayStoreImportDetail, $value);
            
        }

        return $arrayStoreImportDetail;
    }

    // End Function my define
}
