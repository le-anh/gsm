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
          <div class="col-md-12 text-center">
            <h3>Hàng tồn kho<!-- <small>(Nghiệp vụ)</small> --></h3>
          </div>
        </div>
        <div class="row">
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Tìm kiếm theo </label>
              <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                <p>
                  &emsp;&emsp;

                  Mã lô 
                  <input type="radio" class="flat" name="gender" id="genderM" value="M" checked="" required />

                  &emsp;&emsp;

                  Mã nhập kho 
                  <input type="radio" class="flat" name="gender" id="genderF" value="F" />

                  &emsp;&emsp;

                  Khoảng thời gian 
                  <input type="radio" class="flat" name="gender" id="genderM" value="M" checked="" required />

                </p>
              </div>
            </div>

            <div id="divmalo" class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mã nhập <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" placeholder="Mã lô">
              </div>
            </div>

            <div id="divmanhapkho" class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tên đề tài/thí nghiệm <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" placeholder="Mã phiếu nhập kho">
              </div>
            </div>

            <div id="divkhoangthoigian" class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Khoảng thời gian <span class="required">*</span></label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                      <fieldset>
                        <div class="control-group">
                          <div class="controls">
                            <div class="input-prepend input-group">
                              <input type="text" name="reservation" id="reservation" class="form-control" value="01/01/2016 - 01/25/2016" />
                              <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                            </div>
                          </div>
                        </div>
                      </fieldset>
                </div>
              </div>
            </div>
            <div class="ln_solid"></div>
            
            <!-- table thông tin dòng/giống -->
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Tên giống/dòng</th>
                    <th>Mã lô</th>
                    <th>Cấp giống</th>
                    <th>Nguồn gốc</th>
                    <th>Lượng hạt (g) nhập</th>
                    <th>Lượng hạt (g) xuất</th>
                    <th>Lượng hạt (g) tồn</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton Thornton Thornton</td>
                    <td>Thornton Thornton Thornton</td>
                    <td>@fat</td>
                    <td>@fat</td>
                    <td>@fat</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>the Bird</td>
                    <td>the Bird</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="8"><button class="btn btn-primary btn-block">Thêm mới</button></td>
                  </tr>
                </tfoot>
              </table>
            
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                <button class="btn btn-primary" type="button">Cancel</button>
                <button class="btn btn-primary" type="reset">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>

            <div class="ln_solid"></div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<!-- /page content -->

@section('javascript')
  @parent
  <script>
      
      $('#myDatepickerNgayThuHoach').datetimepicker({
          format: 'DD/MM/YYYY',
          ignoreReadonly: true,
          allowInputToggle: true
      });
      
  </script>
@endsection