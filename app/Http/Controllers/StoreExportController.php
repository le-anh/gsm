<?php

namespace App\Http\Controllers;

use App\StoreExport;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExportRequest;
use Auth;
use App\StoreExportDetail;
use App\StoreImportDetail;
use App\StoreImport;
use App\CayTrong;
use App\VuSanXuat;
use App\ChungLoai;
use App\PhanCapGiong;
use Carbon\Carbon;
use Excel;

class StoreExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DS_XuatKho = StoreExport::orderBy('id', 'desc')->get();
        return view('backend.storemanagement.storeexportlist', ['DS_XuatKho' => $DS_XuatKho]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $DS_CayTrong = CayTrong::all();
        $DS_VuSanXuat = VuSanXuat::all();

        return view('backend.storemanagement.storeexport', ['DS_CayTrong' => $DS_CayTrong, 'DS_VuSanXuat' => $DS_VuSanXuat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExportRequest $request)
    {
        // if(Auth::check())
        // {
            // 1. store storeexport
            try {
                $storeExport = new StoreExport();
            
                $storeExport->maxuatkho = $this->generateMaXuatKho();
                $storeExport->tendetaithinghiem = $request->tendetaithinghiem;
                $storeExport->caytrong_id = $request->loaicaytrong;
                $storeExport->vusanxuat_id = $request->vusanxuat;
                $storeExport->ngayxuatkho = Carbon::createFromFormat('d/m/Y', $request->ngayxuatkho);

                $storeExport->save();
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình lưu. <br>Vui lòng nhấn phím F5 (refresh) và thử nhập lại thông tin. <br>'.$e);
            }

            // 2. store storeimportdetail
            $arrayIDStoreExportDetail = array();
            try {

                for($i = 0; $i < count($request->tengiong); $i++) {
                    $storeExportDetail = new StoreExportDetail();

                    $storeExportDetail->storeexport_id = $storeExport->id;
                    $storeExportDetail->malo = $request->malo[$i];

                    //Find and Save info (tendonggiong, phancapgiong_id, nguongoc) with malo

                    try {
                        $storeImportDetail = StoreImportDetail::where('id', '=', $request->maphieunhap[$i])->first();

                        if($storeImportDetail)
                        {
                            $storeExportDetail->storeimportdetail_id = $storeImportDetail->id;
                            $storeExportDetail->tendonggiong = $storeImportDetail->tendonggiong;
                            $storeExportDetail->phancapgiong_id = $storeImportDetail->phancapgiong_id;
                            $storeExportDetail->nguongoc = $storeImportDetail->nguongoc;
                      
                            $storeExportDetail->luongthatxuat = $request->luongthatxuat[$i];
                              
                            $storeExportDetail->save();

                            array_push($arrayIDStoreExportDetail, $storeExportDetail->id);
                      }
                    } catch (Exception $e) {
                    
                }
            }

            } catch (Exception $e) {
                // 2.1. Rollback StoreImportDetail
                $countTryRollback = 0;
                while ( (!($this->rollbackStoreExportDetail($arrayIDStoreImportDetail))) && ($countTryRollback < 5)) {
                    $countTryRollback++;
                }

                // 2.2. Rollback StoreImport
                $this->rollbackStoreExport($storeExport->id);

                return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình lưu. <br>Vui lòng nhấn phím F5 (refresh) và thử nhập lại thông tin. <br>'.$e);
            }
            
            // Store Success
            return redirect()->route('storeexportedit', ['id' => $storeExport->id])->with('success', 'Lưu thành công!');

        // }
        // else
        // {
        //     return redirect()->route('home');
        // }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // echo "string";
        $XuatKho = StoreExport::find($id);
        $DS_CayTrong = CayTrong::all();
        $DS_PhanCapGiong = PhanCapGiong::all();
        $DS_VuSanXuat = VuSanXuat::all();

        return view('backend.storemanagement.storeexportedit', ['XuatKho' => $XuatKho, 'DS_CayTrong' => $DS_CayTrong, 'DS_PhanCapGiong' => $DS_PhanCapGiong, 'DS_VuSanXuat' => $DS_VuSanXuat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StoreExport  $storeExport
     * @return \Illuminate\Http\Response
     */
    public function edit(StoreExport $storeExport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StoreExport  $storeExport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StoreExport $storeExport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StoreExport  $storeExport
     * @return \Illuminate\Http\Response
     */
    // public function destroy(StoreExport $storeExport)
    public function destroy($idStoreExport)
    {
        if(Auth::check()) // Kiểm tra quyền được xóa
        {
            
            try {
                // 1. Xóa StoreExportDetail
                $this::destroyStoreExportDetail($idStoreExport);
                
                // 2. Xóa StoreExport
                StoreExport::destroy($idStoreExport);
                return redirect()->route('storeexportlist')->with('success', "Đã xóa thành công.");
            } catch (Exception $e) {
                return redirect()->route('storeexportlist')->with('danger', "Đã xảy ra lỗi trong quá trình xóa.<br>Vui lòng nhấn phím F5 (refresh) và thử lại.");
            }
        }
        return redirect()->route('home');
    }

    // Function my define
    public function generateMaXuatKho()
    {
        try {
            if(count(StoreExport::all())>0)
                $idXuatKho_Max = StoreExport::orderBy('id', 'desc')->first()->id;
            else
                $idXuatKho_Max = 0;
        } catch (Exception $e) {
            $idXuatKho_Max = 0;
        }
        $preMaXuatKho = "XK".date('Y').date('m').date('d');
        $maXuatKho = $preMaXuatKho . (intval($idXuatKho_Max)+1);

        while (($this->isExistMaXuatKho($maXuatKho))) {

            $maXuatKho = $preMaXuatKho . ((++$idXuatKho_Max)+1);
        }

        return $maXuatKho;
    }

    public function isExistMaXuatKho($maXuatKho)
    {
        $XuatKho = StoreExport::where('maxuatkho', '=', $maXuatKho)->first();

        if($XuatKho)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function rollbackStoreExportDetail($arrayIDStoreExportDetail)
    {
        try {
            foreach ($arrayIDStoreExportDetail as $key => $value) {
                $StoreExport::destroy($arrayIDStoreExportDetail);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
        
        return true;
    }

    public function rollbackStoreExport($idStoreExport)
    {
        // 1. Check has StoreImportDetail
        if(!($this->hasStoreImportDetail($idStoreExport)))
        {
            // 2. Delete (destroy) StoreImport 
            try {
                StoreExport::destroy($idStoreExport);
                return true;
            } catch (Exception $e) {
            }
        }
        else
        {
            $storeExport = StoreExport::find($idStoreImport);
            $storeExport->trangthai = 2; // Chuyển trạng thái lỗi (trangthai = 2).
            $storeExport->save();

            return false;
        }
    }

    public function hasStoreExportDetail($idStoreExport)
    {
        $storeExportDetail = StoreExportDetail::where("storeexport_id", "=", $idStoreExport)->get();

        if($storeExportDetail)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function destroyStoreExportDetail($idStoreExport)
    {
        $storeExport = StoreExport::find($idStoreExport);
        if($storeExport)
        {
            $storeExportDetail = StoreExport::find($idStoreExport)->storeexportdetail;

            if(count($storeExportDetail) > 0)
            {
                foreach ($storeExportDetail as $key => $value) {
                    StoreExportDetailController::destroyByID($value->id);
                }

                return true;
            }
        }

        return false;
    }

    public function exportStoreExport($idStoreExport)
    {
        if(Auth::check())
        {
            $storeExport = StoreExport::find($idStoreExport);
            if($storeExport)
            {
                $fileName = $storeExport->maxuatkho;
                $ext = 'xls';
                $sheetName = $fileName;

                Excel::create($fileName, function($excel) use($sheetName, $storeExport){
                    $excel->sheet($sheetName, function($sheet) use($storeExport){
                        /*
                         * Page setup, Style
                         */
                            // Set font with ->setStyle()
                            $sheet->setStyle(array(
                                'font' => array(
                                    'name'      =>  'Times New Roman',
                                    'size'      =>  12
                                )
                            ));

                            // Set all margins
                            $sheet->setPageMargin(0.25);

                            // Set width for a single column
                            $sheet->setWidth('A', 10);
                            $sheet->setWidth('B', 15);
                            $sheet->setWidth('C', 15);
                            $sheet->setWidth('D', 25);
                            $sheet->setWidth('E', 20);
                            $sheet->setWidth('F', 15);
                            $sheet->setWidth('G', 20);
                        /*
                         * End Page setup, Style
                         */
                        
                        /*
                         * Head 
                         */
                            $row = 1;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $sheet->mergeCells('A' . $row . ':C' . $row);
                            $sheet->cell('A' . $row, function($cell) use($storeExport) {
                                // manipulate the range of cells
                                $cell->setValue('CÔNG TY CP LỘC TRỜI-VIÊN THỊ');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });

                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $sheet->mergeCells('F' . $row . ':G' . $row);
                            $sheet->cell('F' . $row, 'MXK: ' . $storeExport->maxuatkho);
                            
                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $dateImport = Carbon::createFromFormat('Y-m-d', $storeExport->ngayxuatkho);
                            $sheet->mergeCells('F' . $row . ':G' . $row);
                            $sheet->cell('F' . $row, 'Ngày ' . $dateImport->format('d') . ' tháng ' . $dateImport->format('m') . ' năm ' . $dateImport->format('Y')) ;

                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $sheet->mergeCells('A' . $row . ':G' . $row);
                            $sheet->cell('A' . $row, function($cell) use($storeExport) {
                                // manipulate the range of cells
                                $cell->setValue('PHIẾU XUẤT KHO');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });
                            
                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $sheet->mergeCells('A' . $row . ':F' . $row);
                            $sheet->cell('A' . $row, function($cell) use($storeExport) {
                                // manipulate the range of cells
                                $cell->setValue('Tên đề tài/thí nghiệm: ' . $storeExport->tendetaithinghiem);
                            });
                            
                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $sheet->mergeCells('A' . $row . ':C' . $row);
                            $sheet->cell('A' . $row, 'Loại cây trồng: ' . $storeExport->caytrong->tencaytrong);
                            $sheet->mergeCells('D' . $row . ':G' . $row);
                            $sheet->cell('D' . $row, 'Thời vụ: ' . $storeExport->vusanxuat->tenvusanxuat);

                            $row++;
                            
                            $STT = 0;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                        /*
                         * End Head 
                         */

                        /* 
                         Set Title
                         *
                         */

                            // Set border for row
                            $sheet->setBorder('A' . $row . ':G'.$row, 'thin');
                            // STT
                            $sheet->cell('A' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('STT');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });
                            // $sheet->cell('A' . $row, 'STT');

                            // Mã giống
                            $sheet->cell('B' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('Mã dòng/giống');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });

                            // Mã phiếu nhập
                            $sheet->cell('C' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('Mã phiếu nhập');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });

                            // Tên giống/dòng
                            $sheet->cell('D' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('Tên dòng/giống');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });
                            
                            // Cấp giống/dòng
                            $sheet->cell('E' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('Cấp giống/dòng');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });

                            // Nguồn gốc
                            $sheet->cell('F' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('Nguồn gốc');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });

                            // Lượng xuất
                            $sheet->cell('G' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('K.Lượng xuất (g)');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });
                        /*
                         *
                         End Set Title Table
                         *
                         */

                        /*
                         * Content Tabel 
                         */

                            $storeExportDetail = $storeExport->storeExportdetail;
                            if($storeExportDetail)
                            {
                                $tongcong = 0;
                                foreach($storeExportDetail as $value)
                                {
                                    $row++;
                                    $STT++;
                                    $tongcong += intval($value->luongthatxuat);

                                    // Set height for row
                                    $sheet->getRowDimension($row)->setRowHeight(21);

                                    // Set border for row
                                    $sheet->setBorder('A' . $row . ':G'.$row, 'thin');

                                    // STT
                                    $sheet->cell('A' . $row, function($cell) use($STT){
                                        // manipulate the range of cells
                                        $cell->setValue($STT);
                                        $cell->setAlignment('center');
                                    });

                                    // Mã giống
                                    $sheet->cell('B' . $row, function($cell) use($value){
                                        // manipulate the range of cells
                                        $cell->setValue($value->malo);
                                        $cell->setAlignment('center');
                                    });

                                    // Mã phiếu nhập
                                    $sheet->cell('C' . $row, function($cell) use($value, $storeExport){
                                        // manipulate the range of cells
                                        $cell->setValue(StoreImportDetail::where('id', '=', $value->storeimportdetail_id)->first()->storeimport->manhapkho);
                                        $cell->setAlignment('center');
                                    });

                                    // Tên giống/dòng
                                    $sheet->cell('D' . $row, $value->tendonggiong);
                                    
                                    // Cấp giống/dòng
                                    $sheet->cell('E' . $row, $value->phancapgiong->tenphancapgiong);

                                    // Nguồn gốc
                                    $sheet->cell('F' . $row, $value->nguongoc);

                                    // Lượng xuất
                                    $sheet->cell('G' . $row, $value->luongthatxuat);

                                }

                                $row++;
                                // Set height for row
                                $sheet->getRowDimension($row)->setRowHeight(21);
                                // Set border for row
                                $sheet->setBorder('A' . $row . ':G'.$row, 'thin');
                                $sheet->mergeCells('A' . $row . ':F' . $row);
                                $sheet->cell('A' . $row, function($cell){
                                    // manipulate the range of cells
                                    $cell->setValue('Tổng cộng');
                                    $cell->setFontWeight('bold');
                                    $cell->setAlignment('center');
                                });
                                $sheet->cell('G' . $row, function($cell) use($tongcong) {
                                    // manipulate the range of cells
                                    $cell->setValue($tongcong);
                                    $cell->setFontWeight('bold');
                                    $cell->setAlignment('right');
                                });

                            }

                        /*
                         * End Content Tabel 
                         */
                        
                        /*
                         * Footer sign 
                         */
                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $sheet->mergeCells('A' . $row . ':G' . $row);
                            $sheet->cell('A' . $row, function($cell) use($storeExport) {
                                // manipulate the range of cells
                                $cell->setValue('.................., ngày ...... tháng ...... năm ............');
                                $cell->setAlignment('right');
                            });

                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            $sheet->mergeCells('A' . $row . ':C' . $row);
                            $sheet->cell('A' . $row, function($cell) use($storeExport) {
                                // manipulate the range of cells
                                $cell->setValue('TRƯỞNG BỘ PHẬN');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });

                            $sheet->mergeCells('D' . $row . ':E' . $row);
                            $sheet->cell('D' . $row, function($cell) use($storeExport) {
                                // manipulate the range of cells
                                $cell->setValue('NGƯỜI NHẬN');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });
                            
                            $sheet->mergeCells('F' . $row . ':G' . $row);
                            $sheet->cell('F' . $row, function($cell) use($storeExport) {
                                // manipulate the range of cells
                                $cell->setValue('NGƯỜI GIAO');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });
                        /*
                         * End Footer sign 
                         */
                    });
                })->export($ext);
            }
        }
        else
        {
            return redirect()->route('home');
        }
    }
    // End Function my define
}
