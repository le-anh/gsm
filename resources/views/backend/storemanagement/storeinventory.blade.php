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
  
  <!-- My style define -->
  <link href="{{URL::asset('css/mystyle.css')}}" rel="stylesheet">
@endsection

<!-- left menu for staff -->
@section('left_menu')
  @include('backend.storemanagement.layouts.left_menu')
@endsection
<!-- page content -->
@section('page_content')
<div class="right_col" role="main">
  
  <!-- header & char -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">
        
        <div class="row x_title">
          <div class="col-md-12 text-center">
            <h3>THỐNG KÊ TỒN KHO<!-- <small>(Nghiệp vụ)</small> --></h3>
          </div>
        </div>

        @include('layouts.block.message_flash')
        
        <!-- list -->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <div id="countSeedExistAndNotchar" ></div>

                  </div>
                </div>
              </div>
              <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <div id="totalImportExportchar" ></div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end header & char -->

  <div class="clearfix"><br></div>

  <!-- widget -->
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><p class="text-center">THỐNG KÊ TỒN KHO</p> <!-- <small>different design elements</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <div class="row">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats" style="border-color: #EF6739; background: #2A3F54;">
                <div class="icon"><i class="fa fa-gift"></i>
                </div>
                <div class="count">{{$countSeed}}</div>

                <h3>DÒNG/GIỐNG</h3>
                <p>Đang được quản lý</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats" style="border-color: #2A3F54; background: #EF6739;">
                <div class="icon"><i class="fa fa-check-circle"></i>
                </div>
                <div class="count">{{$countSeedExist}}</div>

                <h3>DÒNG/GIỐNG</h3>
                <p>Hiện có trong kho</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats" style="border-color: #286090; background: #1ABB9C;">
                <div class="icon"><i class="fa fa-sign-in"></i>
                </div>
                <div class="count">{{$totalSeedImport}}</div>

                <h3>NHẬP KHO</h3>
                <p>&nbsp;</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats" style="border-color: #1ABB9C; background: #286090">
                <div class="icon"><i class="fa fa-sign-out"></i>
                </div>
                <div class="count">{{$totalSeedExport}}</div>

                <h3>XUẤT KHO</h3>
                <p>&nbsp;</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- end widget -->

  <div class="clearfix"></div>
  <!-- list -->
  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>THÔNG TIN NHẬP - XUẤT - TỒN KHO <!-- <small>different design elements</small> --></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="x_title">
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <div class="form-group text-center">
                <p><h4><label for="">THỐNG KÊ THEO</label></h4></p>
                <label for="searchByDate"> Ngày </label>
                <input type="radio" class="form-radio" name="search" id="searchByDate" value="1" checked="" required />

                &emsp;
                <label for="searchBySeedType"> Tên dòng/giống </label>
                <input type="radio" class="form-radio" name="search" id="searchBySeedType" value="2" />

                &emsp;
                <label for="searchBySeedID"> Mã giống </label>
                <input type="radio" class="form-radio" name="search" id="searchBySeedID" value="3" />

                &emsp;
                <label for="searchByStoreImportID"> Mã nhập kho </label>
                <input type="radio" class="form-radio" name="search" id="searchByStoreImportID" value="4" />
              </div>

              <div class="form-group">
                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-3">
                  <div id="divSearchByDate">
                    <div class="col-md-6">
                      <label class="control-label" for="">Từ ngày</label>
                      <div class="form-group">
                        <div class='input-group date' id='divTuNgay'>
                            <input type='text' id="inpTuNgay" class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label class="control-label" for="">Đến ngày</label>
                      <div class="form-group">
                        <div class='input-group date' id='divDenNgay'>
                            <input type='text' id="inpDenNgay" class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <span class="help-block">
                          <strong id="SearchByDate-help"></strong>
                      </span>
                    </div>
                  </div>
                  <div id="divSearchBySeedType" hidden="true">
                    <input type="text" id="inpSearchBySeedType" class="form-control" placeholder="Tên dòng/giống">
                    
                    <div class="col-md-12 text-center">
                      <span class="help-block">
                          <strong id="SearchBySeedType-help"></strong>
                      </span>
                    </div>
                  </div>

                  <div id="divSearchBySeedID" hidden="true">
                    <input type="text" id="inpSearchBySeedID" class="form-control" placeholder="Mã giống">

                    <div class="col-md-12 text-center">
                      <span class="help-block">
                          <strong id="SearchBySeedID-help"></strong>
                      </span>
                    </div>
                  </div>

                  <div id="divSearchByStoreImportID" hidden="true">
                    <input type="text" id="inpSearchByStoreImportID" class="form-control" placeholder="Mã nhập kho">

                    <div class="col-md-12 text-center">
                      <span class="help-block">
                          <strong id="SearchByStoreImportID-help"></strong>
                      </span>
                    </div>
                  </div>

                </div>
              </div>

              <div class="form-group text-center">
                <a class="btn btn-primary btnSearchSubmit flat"> <i class="fa fa-search"></i> Tìm </a>
              </div>
            </form>

            <div class="clearfix"></div>
          </div>

          <!-- Table thông tin chi tiết -->
          @if(isset($DS_NhapKhoChiTiet))
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" width="100%">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="10%">Mã <br>dòng/giống</th>
                  <th width="10%">Mã <br>phiếu nhập</th>
                  <th width="20%">Tên <br>dòng/giống</th>
                  <th width="10%">Cấp <br>giống</th>
                  <th width="10%">Nguồn <br>gốc</th>
                  <th width="10%">K.Lượng <br>nhập(g)</th>
                  <th width="10%">K.Lượng <br>xuất (g)</th>
                  <th class="text-center"  width="10%">K.Lượng <br>tồn (g)</th>
                  <!-- <th></th> -->
                </tr>
              </thead>

              <tbody id="tbodydetail">
                <?php $stt=0; ?>
                @foreach($DS_NhapKhoChiTiet as $ChiTiet)
                  <tr>
                    <td>{{++$stt}}</td>
                    <td> {{$ChiTiet->malo}} </td>
                    <td> {{$ChiTiet->storeimport->manhapkho}} </td>
                    <td> {{$ChiTiet->tendonggiong}} </td>
                    <td> {{$ChiTiet->phancapgiong->tenphancapgiong}} </td>
                    <td> {{$ChiTiet->nguongoc}} </td>
                    <td> {{$ChiTiet->luong}} </td>
                    <td>
                      {{$luongXuat = App\Http\Controllers\StoreInventoryController::QuatyitySeedExportByStoreImportDetailID($ChiTiet->id)}}
                    </td>
                    <td class="text-center">
                      <?php $luongTon = intval($ChiTiet->luong) - intval($luongXuat); ?>
                      @if(intval($luongTon) < 10)
                        <span class="badge bg-red">{{$luongTon}}</span>
                      @else
                        @if(intval($ChiTiet->luong) < 50)
                          <span class="badge bg-yellow">{{$luongTon}}</span>
                          @else
                          <span class="badge bg-green">{{$luongTon}}</span>
                        @endif
                      @endif
                      
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
            <h3>Không có dữ liệu</h3>
          @endif
          <!-- End Table thông tin chi tiết -->
        </div>
      </div>
    </div>
  </div>
  <!-- end list -->
</div>
@endsection
<!-- /page content -->

@section('javascript')
  @parent
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
    
    <!-- Google char -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    

    <!-- Script my define -->
    <script src="{{URL::asset('js/storeinventory.js')}}"></script>

    <script type="text/javascript">

      var path_localhost =  "{{URL::to('/')}}" + "/";
      
      var routeGetMaGiongInfoByDate = "{{route('getmagionginfobydate')}}";
      var routeGetMaGiongInfoBySeedType = "{{route('getmagionginfobyseedtype')}}";
      var routeGetMaGiongInfoBySeedID = "{{route('getmagionginfobyseedid')}}";
      var routeGetMaGiongInfoByStoreImportID = "{{route('getmagionginfobystoreimportid')}}";

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        // Số lượng giống còn tồn & hết hàng
        var countSeed = parseInt("<?php echo $countSeed; ?>");
        var countSeedExist = parseInt("<?php echo $countSeedExist; ?>");

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Lượng giống còn tồn trong kho',    countSeedExist],
          ['Lượng giống hết trong kho', countSeed - countSeedExist]
        ]);

        var options = {
          title: 'Số lượng giống còn tồn và hết trong kho',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('countSeedExistAndNotchar'));
        chart.draw(data, options);
        // End số lượng giống còn tồn & hết hàng

        // Tổng lượng nhập và xuất
        var totalSeedImport = parseInt("<?php echo $totalSeedImport; ?>");
        var totalSeedExport = parseInt("<?php echo $totalSeedExport; ?>");

        var datatotalImportExport = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Tổng lượng nhập kho',    totalSeedImport],
          ['Tổng lượng xuất kho', totalSeedExport]
        ]);

        var optionstotalImportExport = {
          title: 'Tổng lượng nhập và xuất kho',
          is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('totalImportExportchar'));
        chart.draw(datatotalImportExport, optionstotalImportExport);
        // Tổng lượng nhập và xuất
      }

      $('#divTuNgay').datetimepicker({
        format: 'DD/MM/YYYY'
      });

      $('#divDenNgay').datetimepicker({
        format: 'DD/MM/YYYY'
      });
    </script>
@endsection