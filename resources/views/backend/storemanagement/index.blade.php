@extends('layouts.themes.gentelella.backend_master')
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
          <div class="col-md-6">
            <h3><i class="fa fa-desktop"></i> Chức năng <small>(Nghiệp vụ)</small></h3>
          </div>
        </div>
        <div class="row text-center">
          <!-- Nhập kho -->
          <a href="{{route('storeimport')}}">
            <div class="col-md-55 col-md-offset-3">
              <div class="thumbnail text-center">
                <div class="image view view-first text-center">
                  <img style="width: 100%; display: block;" src="{{URL::asset('images/import.png')}}" alt="image" />
                </div>
                <div class="caption text-center">
                  <h4><span class="glyphicon glyphicon-import" aria-hidden="true"></span> NHẬP KHO</h4>
                </div>
              </div>
            </div>
          </a>

          <!-- Xuất kho -->
          <a href="{{route('storeexport')}}">
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="{{URL::asset('images/export.png')}}" alt="image" />
                </div>
                <div class="caption text-center">
                  <h4><span class="glyphicon glyphicon-export" aria-hidden="true"></span> XUẤT KHO</h4>
                </div>
              </div>
            </div>
          </a>
        </div>
        
        <br>

        <!-- List: Import, Export -->
        <div class="row x_title">
          <div class="col-md-6">
            <h3><i class="fa fa-bar-chart-o"></i> Thống kê <small>(Liệt kê)</small></h3>
          </div>
        </div>
        <div class="row text-center">
          <!-- Nhập kho -->
          <a href="{{route('storeimportlist')}}">
            <div class="col-md-55">
              <div class="thumbnail text-center">
                <div class="image view view-first text-center">
                  <img style="width: 100%; display: block;" src="{{URL::asset('images/import.png')}}" alt="image" />
                </div>
                <div class="caption text-center">
                  <h4><span class="glyphicon glyphicon-import" aria-hidden="true"></span> DS NHẬP KHO</h4>
                  <!-- <div class="col-sm-12 col-md-9"><h4>DANH SÁCH NHẬP KHO</h4></div>
                  <h4>DANH SÁCH<br>NHẬP KHO</h4> -->
                </div>
              </div>
            </div>
          </a>

          <!-- Xuất kho -->
          <a href="{{route('storeexportlist')}}">
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="{{URL::asset('images/export.png')}}" alt="image" />
                </div>
                <div class="caption text-center">
                  <h4> <span class="glyphicon glyphicon-export" aria-hidden="true"></span> DS XUẤT KHO</h4>
                </div>
              </div>
            </div>
          </a>

          <!-- Tồn kho -->
          <a href="{{route('storeinventory')}}">
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="{{URL::asset('images/statistic.png')}}" alt="image" />
                </div>
                <div class="caption text-center">
                  <h4><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> TỒN KHO</h4>
                </div>
              </div>
            </div>
          </a>

          <!-- Kiểm kê (Kiểm kho) -->
          <a href="{{route('storestatisticaldata')}}">
            <div class="col-md-55">
              <div class="thumbnail">
                <div class="image view view-first">
                  <img style="width: 100%; display: block;" src="{{URL::asset('images/store_statistic.png')}}" alt="image" />
                </div>
                <div class="caption text-center">
                  <h4> <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> KIỂM KÊ</h4>
                </div>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
<!-- /page content -->