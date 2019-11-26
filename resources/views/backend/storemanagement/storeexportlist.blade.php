@extends('layouts.themes.gentelella.backend_master')

<!-- css -->
@section('css')
  @parent
  <!-- Datatables -->
  <link href="{{URL::asset('themes/gentelella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('themes/gentelella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('themes/gentelella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('themes/gentelella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::asset('themes/gentelella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
@endsection

<!-- left menu for staff -->
@section('left_menu')
  @include('backend.storemanagement.layouts.left_menu')
@endsection
<!-- page content -->
@section('page_content')
<div class="right_col" role="main">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">
        
        <div class="row x_title">
          <div class="col-md-12 text-center">
            <h3>DANH SÁCH XUẤT KHO<!-- <small>(Nghiệp vụ)</small> --></h3>
          </div>
        </div>

        @include('layouts.block.message_flash')
        
        <!-- list -->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
              <div class="row x_title">
                <div class="col-md-12">
                  <a href="{{route('storeexport')}}" class="btn btn-primary"><i class="fa fa-plus"></i> XUẤT KHO </a>
                </div>
              </div>
              
              @if(isset($DS_XuatKho))
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Mã phiếu xuất</th>
                      <th>Tên đề tài/thí nghiệm</th>
                      <th>Loại cây</th>
                      <th>Thời vụ</th>
                      <!-- <th>Ngày thu hoạch</th> -->
                      <th>Ngày xuất kho</th>
                      <th></th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php $stt=0; ?>
                    @foreach($DS_XuatKho as $XuatKho)
                      <tr>
                        <td>{{++$stt}}</td>
                        <td> {{$XuatKho->maxuatkho}} </td>
                        <td> {{$XuatKho->tendetaithinghiem}} </td>
                        <td> {{$XuatKho->caytrong->tencaytrong}} </td>
                        <td> {{$XuatKho->vusanxuat->tenvusanxuat}} </td>
                        <!-- <td> </td> -->
                        <td> {{Carbon\Carbon::createFromFormat('Y-m-d', $XuatKho->ngayxuatkho)->format('d/m/Y')}} </td>
                        <td class="text-center">
                          <a target="_blank" href="{{route('storeexportedit', ['id' => $XuatKho->id])}}" class="btn btn-info" title="Click vào để xem thông tin chi tiết"><i class="fa fa-info"></i></a>
                          <a href="{{route('storeexportdestroy', ['id' => $XuatKho->id])}}" class="btn btn-danger remove-store-export" title="Click vào để xóa"><i class="fa fa-remove"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @else
                <h3>Không có dữ liệu</h3>
              @endif

              <div class="row x_title">
                <div class="col-md-12">
                  <a href="{{route('storeexport')}}" class="btn btn-primary"><i class="fa fa-plus"></i> XUẤT KHO </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end list -->
      </div>
    </div>
  </div>
</div>
@endsection
<!-- /page content -->

@section('javascript')
  @parent
    <!-- Store Export -->
    <script src="{{URL::asset('js/storeexport.js')}}"></script>
    
    <!-- Datatables -->
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('themes/gentelella/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

  <script>

      var path_localhost =  "{{URL::to('/')}}" + "/";

      $('#myDatepickerNgayThuHoach').datetimepicker({
          format: 'DD/MM/YYYY',
          ignoreReadonly: true,
          allowInputToggle: true
      });

      $('#myDatepickerNgayNhapKho').datetimepicker({
          format: 'DD/MM/YYYY',
          ignoreReadonly: true,
          allowInputToggle: true
      });
      
  </script>
@endsection