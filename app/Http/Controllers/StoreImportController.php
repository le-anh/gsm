<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreImportRequest;
use Auth;
use App\CayTrong;
use App\ChungLoai;
use App\PhanCapGiong;
use App\VuSanXuat;
use App\StoreImport;
use App\StoreImportDetail;
use Carbon\Carbon;
use Excel;

class StoreImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $DS_NhapKho = StoreImport::orderBy('id', 'desc')->get();
        return view('backend.storemanagement.storeimportlist', ['DS_NhapKho' => $DS_NhapKho]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $DS_CayTrong = CayTrong::all();
        $DS_PhanCapGiong = PhanCapGiong::all();
        $DS_VuSanXuat = VuSanXuat::all();

        return view('backend.storemanagement.storeimport', ['DS_CayTrong' => $DS_CayTrong,'DS_PhanCapGiong' => $DS_PhanCapGiong, 'DS_VuSanXuat' => $DS_VuSanXuat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImportRequest $request)
    {
        // print_r($request->toArray());
        if(Auth::check())
        {
            // 1. store storeimport
            try {
                $storeImport = new StoreImport();
            
                $storeImport->manhapkho = $this->generateMaNhapKho();
                $storeImport->tendetaithinghiem = $request->tendetaithinghiem;
                $storeImport->caytrong_id = $request->loaicaytrong;
                $storeImport->vusanxuat_id = $request->vusanxuat;
                // $storeImport->ngaythuhoach = date('Y-m-d', strtotime($request->ngaythuhoach));
                // $storeImport->ngaythuhoach = Carbon::createFromFormat('d/m/Y', $request->ngaythuhoach);
                $storeImport->ngaynhapkho = Carbon::createFromFormat('d/m/Y', $request->ngaynhapkho);

                $storeImport->save();
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình lưu. <br>Vui lòng nhấn phím F5 (refresh) và thử nhập lại thông tin. <br>'.$e);
            }

            // 2. store storeimportdetail
            $arrayIDStoreImportDetail = array();
            try {

                for($i = 0; $i < count($request->tengiong); $i++) {
                $storeImportDetail = new StoreImportDetail();

                $storeImportDetail->storeimport_id = $storeImport->id;
                $storeImportDetail->tendonggiong = $request->tengiong[$i];
                $storeImportDetail->malo = $request->malo[$i];
                $storeImportDetail->phancapgiong_id = $request->capgiong[$i];
                $storeImportDetail->nguongoc = $request->nguongoc[$i];
                $storeImportDetail->ngaythuhoachthuthap = Carbon::createFromFormat('d/m/Y', $request->ngaythuhoachthuthap[$i]);
                $storeImportDetail->luong = $request->luong[$i];
                $storeImportDetail->tylenaymam = $request->tylenaymam[$i];
                  
                $storeImportDetail->save();

                array_push($arrayIDStoreImportDetail, $storeImportDetail->id);
            }

            } catch (Exception $e) {
                // 2.1. Rollback StoreImportDetail
                $countTryRollback = 0;
                while ( (!($this->rollbackStoreImportDetail($arrayIDStoreImportDetail))) && ($countTryRollback < 5)) {
                    $countTryRollback++;
                }

                // 2.2. Rollback StoreImport
                $this->rollbackStoreImport($storeImport->id);

                return redirect()->back()->with('error', 'Có lỗi xảy ra trong quá trình lưu. <br>Vui lòng nhấn phím F5 (refresh) và thử nhập lại thông tin. <br>'.$e);
            }
            
            // Store Success
            return redirect()->route('storeimportedit',['id' => $storeImport->id])->with('success', 'Lưu thành công!');

        }
        else
        {
            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $NhapKho = StoreImport::find($id);
        $DS_CayTrong = CayTrong::all();
        $DS_PhanCapGiong = PhanCapGiong::all();
        $DS_VuSanXuat = VuSanXuat::all();

        return view('backend.storemanagement.storeimportedit', ['NhapKho' => $NhapKho, 'DS_CayTrong' => $DS_CayTrong, 'DS_PhanCapGiong' => $DS_PhanCapGiong, 'DS_VuSanXuat' => $DS_VuSanXuat]);
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
        // if(Auth::check()) // Kiểm tra quyền được xóa
        // {
            // 1. Xóa StoreImportDetail
            $this::destroyStoreImportDetail($id);

            // 2. Xóa StoreExport
            try {
                StoreImport::destroy($id);
                return redirect()->route('storeimportlist')->with('success', "Đã xóa thành công.");
            } catch (Exception $e) {
                return redirect()->route('storeimportlist')->with('danger', "Đã xảy ra lỗi trong quá trình xóa.<br>Vui lòng nhấn phím F5 (refresh) và thử lại.");
            }
        // }
        // return redirect()->route('home');
    }

    // Function my define
    public function generateMaNhapKho()
    {
        try {
            if(count(StoreImport::all())>0)
                $idNhapKho_Max = StoreImport::orderBy('id', 'desc')->first()->id;
            else
                $idNhapKho_Max = 0;
        } catch (Exception $e) {
            $idNhapKho_Max = 0;
        }

        $preMaNhapKho = "NK".date('Y').date('m').date('d');
        
        $maNhapKho = $preMaNhapKho . (intval($idNhapKho_Max)+1);

        while (($this->isExistMaNhapKho($maNhapKho))) {

            $maNhapKho = $preMaNhapKho . ((++$idNhapKho_Max)+1);
        }

        return $maNhapKho;
    }

    public function isExistMaNhapKho($maNhapKho)
    {
        $NhapKho = StoreImport::where('manhapkho', '=', $maNhapKho)->first();

        if($NhapKho)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function rollbackStoreImportDetail($arrayIDStoreImportDetail)
    {
        try {
            foreach ($arrayIDStoreImportDetail as $key => $value) {
                $StoreImport::destroy($arrayIDStoreImportDetail);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
        
        return true;
    }

    public function rollbackStoreImport($idStoreImport)
    {
        // 1. Check has StoreImportDetail
        if(!($this->hasStoreImportDetail($idStoreImport)))
        {
            // 2. Delete (destroy) StoreImport 
            try {
                StoreImport::destroy($idStoreImport);
                return true;
            } catch (Exception $e) {
            }
        }
        else
        {
            $storeImport = StoreImport::find($idStoreImport);
            $storeImport->trangthai = 2; // Chuyển trạng thái lỗi (trangthai = 2).
            $storeImport->save();

            return false;
        }
    }

    public function hasStoreImportDetail($idStoreImport)
    {
        $storeImportDetail = StoreImportDetail::where("storeimport_id", "=", $idStoreImport)->get();

        if($storeImportDetail)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function destroyStoreImportDetail($idStoreImport)
    {
        $storeImport = StoreImport::find($idStoreImport);
        if($storeImport)
        {
            $storeImportDetail = StoreImport::find($idStoreImport)->storeimportdetail;

            if(count($storeImportDetail) > 0)
            {
                foreach ($storeImportDetail as $key => $value) {
                    return StoreImportDetailController::destroyByID($value->id);
                }
            }
        }

        return false;
    }

    public function exportStoreImport($idStoreImport)
    {
        if(Auth::check())
        {
            $storeImport = StoreImport::find($idStoreImport);
            if($storeImport)
            {
                $fileName = $storeImport->manhapkho;
                $ext = 'xls';
                $sheetName = $fileName;

                Excel::create($fileName, function($excel) use ($sheetName, $storeImport) {

                    $excel->sheet($sheetName, function($sheet) use($storeImport){
                        // Set freeze
                        // $sheet->setFreeze('A6');
                        // Set Orentation with ->setOrientation()
                        // $sheet->setOrientation('landscape');

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
                        $sheet->setWidth('C', 25);
                        $sheet->setWidth('D', 20);
                        $sheet->setWidth('E', 15);
                        $sheet->setWidth('F', 20);
                        // $sheet->setWidth('G', 10);
                        // $sheet->setWidth('H', 27);
                        // $sheet->setWidth('I', 33);
                        // $sheet->setWidth('J', 13);

                        // Set height for row
                        $sheet->getRowDimension(150)->setRowHeight(50);

                        $row = 1;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $sheet->mergeCells('A' . $row . ':C' . $row);
                        $sheet->cell('A' . $row, function($cell) use($storeImport) {
                            // manipulate the range of cells
                            $cell->setValue('CÔNG TY CP LỘC TRỜI-VIÊN THỊ');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });
                        // $sheet->cell('A' . $row, 'CÔNG TY CP LỘC TRỜI-VIÊN THỊ');

                        $row++;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $sheet->mergeCells('E' . $row . ':F' . $row);
                        $sheet->cell('E' . $row, 'MNK: ' . $storeImport->manhapkho);
                        
                        $row++;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $dateImport = Carbon::createFromFormat('Y-m-d', $storeImport->ngaynhapkho);
                        $sheet->mergeCells('E' . $row . ':F' . $row);
                        $sheet->cell('E' . $row, 'Ngày ' . $dateImport->format('d') . ' tháng ' . $dateImport->format('m') . ' năm ' . $dateImport->format('Y')) ;

                        $row++;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $sheet->mergeCells('A' . $row . ':F' . $row);
                        $sheet->cell('A' . $row, function($cell) use($storeImport) {
                            // manipulate the range of cells
                            $cell->setValue('PHIẾU NHẬP KHO');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });
                        // $sheet->cell('A' . $row, 'PHIẾU NHẬP KHO');
                        
                        $row++;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $sheet->mergeCells('A' . $row . ':F' . $row);
                        $sheet->cell('A' . $row, function($cell) use($storeImport) {
                            // manipulate the range of cells
                            $cell->setValue('Tên đề tài/thí nghiệm: ' . $storeImport->tendetaithinghiem);
                        });
                        // $sheet->mergeCells('A' . $row . ':F' . $row);
                        // $sheet->cell('A' . $row, 'Tên đề tài/thí nghiệm: ' . $storeImport->tendetaithinghiem);
                        
                        $row++;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $sheet->mergeCells('A' . $row . ':C' . $row);
                        $sheet->cell('A' . $row, 'Loại cây trồng: ' . $storeImport->caytrong->tencaytrong);
                        $sheet->mergeCells('D' . $row . ':F' . $row);
                        $sheet->cell('D' . $row, 'Thời vụ: ' . $storeImport->vusanxuat->tenvusanxuat);

                        $row++;
                        
                        $STT = 0;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);

                        // Set border for row
                        $sheet->setBorder('A' . $row . ':F'.$row, 'thin');
                        // Set Title
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
                        // $sheet->cell('B' . $row, 'Mã giống');

                        // Tên giống/dòng
                        $sheet->cell('C' . $row, function($cell){
                            // manipulate the range of cells
                            $cell->setValue('Tên giống/dòng');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });
                        // $sheet->cell('C' . $row, 'Tên giống/dòng');
                        
                        // Cấp giống/dòng
                        $sheet->cell('D' . $row, function($cell){
                            // manipulate the range of cells
                            $cell->setValue('Cấp giống/dòng');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });
                        // $sheet->cell('D' . $row, 'Cấp giống/dòng');

                        // Lượng hạt (g)
                        $sheet->cell('E' . $row, function($cell){
                            // manipulate the range of cells
                            $cell->setValue('Lượng hạt (g)');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });
                        // $sheet->cell('E' . $row, 'Lượng hạt (g)');

                        // Tỷ lệ nảy mầm (%)
                        $sheet->cell('F' . $row, function($cell){
                            // manipulate the range of cells
                            $cell->setValue('Tỷ lệ nảy mầm (%)');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });
                        // $sheet->cell('F' . $row, 'Tỷ lệ nảy mầm (%)');

                        $storeImportDetail = $storeImport->storeimportdetail;
                        if($storeImportDetail)
                        {
                            $tongcong = 0;
                            foreach($storeImportDetail as $value)
                            {
                                $row++;
                                $STT++;
                                $tongcong += intval($value->luong);

                                // Set border for row
                                $sheet->setBorder('A' . $row . ':F'.$row, 'thin');

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

                                // Tên giống/dòng
                                $sheet->cell('C' . $row, $value->tendonggiong);
                                
                                // Cấp giống/dòng
                                $sheet->cell('D' . $row, $value->phancapgiong->tenphancapgiong);

                                // Lượng hạt (g)
                                $sheet->cell('E' . $row, $value->luong);

                                // Tỷ lệ nảy mầm (%)
                                $sheet->cell('F' . $row, $value->tylenaymam);

                            }

                            $row++;
                            // Set height for row
                            $sheet->getRowDimension($row)->setRowHeight(21);
                            // Set border for row
                            $sheet->setBorder('A' . $row . ':F'.$row, 'thin');
                            $sheet->mergeCells('A' . $row . ':D' . $row);
                            $sheet->cell('A' . $row, function($cell){
                                // manipulate the range of cells
                                $cell->setValue('Tổng cộng');
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('center');
                            });
                            $sheet->cell('E' . $row, function($cell) use($tongcong) {
                                // manipulate the range of cells
                                $cell->setValue($tongcong);
                                $cell->setFontWeight('bold');
                                $cell->setAlignment('right');
                            });

                        }

                        // footer sign
                        $row++;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $sheet->mergeCells('A' . $row . ':F' . $row);
                        $sheet->cell('A' . $row, function($cell) use($storeImport) {
                            // manipulate the range of cells
                            $cell->setValue('.................., ngày ...... tháng ...... năm ............');
                            $cell->setAlignment('right');
                        });

                        $row++;
                        // Set height for row
                        $sheet->getRowDimension($row)->setRowHeight(21);
                        $sheet->mergeCells('A' . $row . ':B' . $row);
                        $sheet->cell('A' . $row, function($cell) use($storeImport) {
                            // manipulate the range of cells
                            $cell->setValue('TRƯỞNG BỘ PHẬN');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });

                        $sheet->mergeCells('C' . $row . ':D' . $row);
                        $sheet->cell('C' . $row, function($cell) use($storeImport) {
                            // manipulate the range of cells
                            $cell->setValue('NGƯỜI NHẬN');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });
                        
                        $sheet->mergeCells('E' . $row . ':F' . $row);
                        $sheet->cell('E' . $row, function($cell) use($storeImport) {
                            // manipulate the range of cells
                            $cell->setValue('NGƯỜI GIAO');
                            $cell->setFontWeight('bold');
                            $cell->setAlignment('center');
                        });

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
