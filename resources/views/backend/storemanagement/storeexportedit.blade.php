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
            <h3>XUẤT KHO<!-- <small>(Nghiệp vụ)</small> --></h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="{{route('post_storeexport')}}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
              {{csrf_field()}}

              @include('layouts.block.message_flash')

              @if(isset($XuatKho) && $XuatKho)
              
                <div class="row">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mã xuất </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="maxuatkho" class="form-control col-md-7 col-xs-12" value="{{old('maxuatkho', $XuatKho->maxuatkho)}}" readonly="true" placeholder="Mã xuất kho sẽ được hệ thống tự cấp khi lưu">
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('tendetaithinghiem') ? ' has-error' : '' }}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="first-name">Tên đề tài/thí nghiệm <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="tendetaithinghiem" class="form-control col-md-7 col-xs-12" value="{{old('tendetaithinghiem', $XuatKho->tendetaithinghiem)}}" placeholder="Tên đề tài/thí nghiệm">
                      
                      @if ($errors->has('tendetaithinghiem'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tendetaithinghiem') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('loaicaytrong') ? ' has-error' : '' }}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Loại cây trồng <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="loaicaytrong" class="form-control">
                          <option value="0">Chọn loại cây trồng</option>
                          @if(isset($DS_CayTrong))
                            @foreach($DS_CayTrong as $CayTrong)
                              <option value="{{$CayTrong->id}}" {{old('loaicaytrong', $XuatKho->caytrong_id) == $CayTrong->id ? 'selected = "true"' : ''}}>{{$CayTrong->tencaytrong}}</option>
                            @endforeach
                          @endif
                        </select>

                        @if ($errors->has('loaicaytrong'))
                          <span class="help-block">
                              <strong>{{ $errors->first('loaicaytrong') }}</strong>
                          </span>
                        @endif
                    </div>
                  </div>

                  <div class="form-group{{ $errors->has('vusanxuat') ? ' has-error' : '' }}">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Thời vụ <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                      
                      @if(isset($DS_VuSanXuat))
                        @if(count($DS_VuSanXuat) > 4)
                          <select name="vusanxuat" class="form-control">
                            <option value="0">Chọn vụ sản xuất</option>
                              @foreach($DS_VuSanXuat as $VuSanXuat)
                                <option value="{{$VuSanXuat->id}}" {{(old('vusanxuat', $XuatKho->vusanxuat_id)==$VuSanXuat->id)? 'selected="true"' : ''}}>{{$VuSanXuat->tenvusanxuat}}</option>
                              @endforeach
                          </select>
                        @else
                          <p>
                            @foreach($DS_VuSanXuat as $VuSanXuat)
                              &emsp;&emsp;
                              
                              <label for="radvusanxuat{{$VuSanXuat->id}}">{{$VuSanXuat->tenvusanxuat}} </label>
                              
                              <input type="radio" class="flat" name="vusanxuat" id="radvusanxuat{{$VuSanXuat->id}}" value="{{$VuSanXuat->id}}" {{(old('vusanxuat', $XuatKho->vusanxuat_id)==$VuSanXuat->id)? 'checked="true"' : ''}}/>
                            @endforeach
                          </p>
                        @endif
                      @endif

                      @if ($errors->has('vusanxuat'))
                        <span class="help-block">
                            &emsp;&emsp;
                            <strong>{{ $errors->first('vusanxuat') }}</strong>
                        </span>
                      @endif
                      
                    </div>
                  </div>
                  
                  <!-- <div class="form-group{{ $errors->has('ngaythuhoach') ? ' has-error' : '' }}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày thu hoạch <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                          <div class='input-group date' id='myDatepickerNgayThuHoach'>
                              <input type='text' name="ngaythuhoach" class="form-control" value="{{old('ngaythuhoach')}}" placeholder="Ngày thu hoạch (dd/mm/YYYY)" />
                              <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>

                          @if ($errors->has('ngaythuhoach'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ngaythuhoach') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group{{ $errors->has('ngayxuatkho') ? ' has-error' : '' }}">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày xuất kho <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                          <div class='input-group date' id='myDatepickerNgayXuatKho'>
                              <input type='text' name="ngayxuatkho" class="form-control" value="{{old('ngayxuatkho', Carbon\Carbon::createFromFormat('Y-m-d', $XuatKho->ngayxuatkho)->format('d/m/Y'))}}" placeholder="date('d/m/Y')" />
                              <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>

                          @if ($errors->has('ngayxuatkho'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ngayxuatkho') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                  </div>
                
                  <div class="row col-12">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_content">
                        <!-- table thông tin dòng/giống -->
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Mã lô</th>
                                <th>Mã phiếu nhập</th>
                                <th>Tên giống/dòng</th>
                                <th>Cấp giống</th>
                                <th>Nguồn gốc</th>
                                <!-- <th>Lượng đề nghị(g)</th> -->
                                <th>Lượng xuất</th>
                                <!-- <th></th> -->
                              </tr>
                            </thead>
                            
                            <tbody id="tbody_seeddetail">
                              <tr id="tr0" hidden="true">
                                <th id="stt_tr0" scope="row"></th>
                                <td id="td1">
                                  <div id="divmalo_tr0" class="form-group">
                                    <input id="inpmalo_tr0" type="text" class="form-control" placeholder="Mã lô">
                                    <span class="help-block">
                                        <strong id="malo_helpblock_tr0"></strong>
                                    </span>
                                  </div>
                                </td>

                                <td id="td2">
                                  <div id="divtengiong_tr0" class="form-group">
                                    <select id="seltengiong_tr0" class="form-control">
                                      <option value="0">Chọn giống/dòng</option>
                                      @if(isset($DS_ChungLoai))
                                        @foreach($DS_ChungLoai as $ChungLoai)
                                          <option value="{{$ChungLoai->id}}">{{$ChungLoai->tenchungloai}}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                    <span class="help-block">
                                        <strong id="tengiong_helpblock_tr0"></strong>
                                    </span>
                                  </div>
                                </td>

                                <td id="td3">
                                  <div id="divcapgiong_tr0" class="form-group">
                                    <select id="selcapgiong_tr0" class="form-control">
                                      <option value="0">Chọn cấp</option>
                                      @if(isset($DS_PhanCapGiong))
                                        @foreach($DS_PhanCapGiong as $PhanCapGiong)
                                          <option value="{{$PhanCapGiong->id}}">{{$PhanCapGiong->id}} - {{$PhanCapGiong->tenphancapgiong}}</option>
                                        @endforeach
                                      @endif
                                    </select>
                                    <span class="help-block">
                                        <strong id="capgiong_helpblock_tr0"></strong>
                                    </span>
                                  </div>
                                </td>

                                <td id="td4">
                                  <div id="divnguongoc_tr0" class="form-group">
                                    <input id="inpnguongoc_tr0" type="text" class="form-control" placeholder="Nguồn gốc">
                                    <span class="help-block">
                                        <strong id="nguongoc_helpblock_tr0"></strong>
                                    </span>
                                  </div>
                                </td>
                                <td id="td5">
                                  <div id="divluong_tr0" class="form-group">
                                    <input id="inpluong_tr0" type="number" class="form-control" placeholder="hạt (g)">
                                    <span class="help-block">
                                        <strong id="luong_helpblock_tr0"></strong>
                                    </span>
                                  </div>
                                </td>
                                <td id="td6">
                                  <div id="divtylenaymam_tr0" class="form-group">
                                    <input id="inptylenaymam_tr0" type="number" class="form-control" placeholder="%">
                                    <span class="help-block">
                                        <strong id="tylenaymam_helpblock_tr0"></strong>
                                    </span>
                                  </div>
                                </td>
                                <td id="tr0_td7" class="text-center">
                                  <button class="btn btn-warning btn-remove-row" title="Xóa bỏ dòng này"><i class="fa fa-remove"></i></button>
                                </td>
                              </tr>

                              @if(old('maxuatkho'))
                                @for($i = 0; $i < count(old('tengiong')); $i++)
                                  {{$trid = 'tr'.($i+1)}}
                                  <tr id="{{$trid}}">
                                    <th id="stt_{{$trid}}" scope="row">{{($i+1)}}</th>

                                    <td>
                                      <div id="divmalo_{{$trid}}" class="form-group">
                                        <input id="inpmalo_{{$trid}}" name="malo[]" type="text" class="form-control" value="{{(old('malo.'.$i))}}" placeholder="Mã lô">
                                        <span class="help-block">
                                            <strong id="malo_helpblock_{{$trid}}"></strong>
                                        </span>
                                      </div>
                                    </td>

                                    <td>
                                      <div id="divtengiong_{{$trid}}" class="form-group">
                                        <select id="seltengiong_{{$trid}}" name="tengiong[]" class="form-control">
                                          <option value="0">Chọn giống/dòng</option>
                                          @if(isset($DS_ChungLoai))
                                            @foreach($DS_ChungLoai as $ChungLoai)
                                              <option value="{{$ChungLoai->id}}" {{(old('tengiong.'.$i) == $ChungLoai->id) ? 'selected="true"' : ''}}>{{$ChungLoai->tenchungloai}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                        <span class="help-block">
                                            <strong id="tengiong_helpblock_{{$trid}}"></strong>
                                        </span>
                                      </div>
                                    </td>

                                    <td>
                                      <div id="divcapgiong_{{$trid}}" class="form-group">
                                        <select id="selcapgiong_{{$trid}}" name="capgiong[]" class="form-control">
                                          <option value="0">Chọn cấp</option>
                                          @if(isset($DS_PhanCapGiong))
                                            @foreach($DS_PhanCapGiong as $PhanCapGiong)
                                              <option value="{{$PhanCapGiong->id}}" {{(old('capgiong.'.$i) == $PhanCapGiong->id) ? 'selected="true"' : ''}}>{{$PhanCapGiong->id}} - {{$PhanCapGiong->tenphancapgiong}}</option>
                                            @endforeach
                                          @endif
                                        </select>
                                        <span class="help-block">
                                            <strong id="capgiong_helpblock_{{$trid}}"></strong>
                                        </span>
                                      </div>
                                    </td>

                                    <td>
                                      <div id="divnguongoc_{{$trid}}" class="form-group">
                                        <input id="inpnguongoc_{{$trid}}" type="text" name="nguongoc[]" class="form-control" value="{{(old('nguongoc.'.$i))}}" placeholder="Nguồn gốc">
                                        <span class="help-block">
                                            <strong id="nguongoc_helpblock_{{$trid}}"></strong>
                                        </span>
                                      </div>
                                    </td>
                                    <td>
                                      <div id="divluong_{{$trid}}" class="form-group">
                                        <input id="inpluong_{{$trid}}" type="number" name="luong[]" class="form-control" value="{{(old('luong.'.$i))}}" placeholder="hạt (g)">
                                        <span class="help-block">
                                            <strong id="luong_helpblock_{{$trid}}"></strong>
                                        </span>
                                      </div>
                                    </td>
                                    <td>
                                      <div id="divtylenaymam_{{$trid}}" class="form-group">
                                        <input id="inptylenaymam_{{$trid}}" type="number" name="tylenaymam[]" class="form-control" value="{{(old('tylenaymam.'.$i))}}" placeholder="%">
                                        <span class="help-block">
                                            <strong id="tylenaymam_helpblock_{{$trid}}"></strong>
                                        </span>
                                      </div>
                                    </td>
                                    <td class="text-center">
                                      <a class="btn btn-warning btn-remove-row" title="Xóa bỏ dòng này"><i class="fa fa-remove"></i></a>
                                    </td>
                                  </tr>
                                @endfor
                              @else
                                @if($XuatKho->storeexportdetail)
                                  <?php $i = 0; ?>
                                  @foreach($XuatKho->storeexportdetail as $ChiTiet)
                                    <?php $trid = 'tr'.(++$i); ?>
                                    <tr id="{{$trid}}">
                                      <th id="stt_{{$trid}}" scope="row">1</th>

                                      <td>
                                        <div id="divmalo_{{$trid}}" class="form-group">
                                          <input id="inpmalo_{{$trid}}" type="text" name="malo[]" value="{{$ChiTiet->malo}}" class="form-control autocompletemalo" placeholder="Mã lô">
                                          <span class="help-block">
                                              <strong id="malo_helpblock_{{$trid}}"></strong>
                                          </span>
                                        </div>
                                      </td>

                                      <td>
                                        <div id="divmanhapkho_{{$trid}}" class="form-group">
                                          <input id="inpmanhapkho_{{$trid}}" type="text" name="manhapkho[]" class="form-control" value="{{App\StoreImportDetail::where('malo', '=', $ChiTiet->malo)->first()->storeimport->manhapkho}}" placeholder="Tên giống" readonly="true">
                                          <span class="help-block">
                                            <strong id="manhapkho_helpblock_{{$trid}}"></strong>
                                          </span>
                                        </div>
                                      </td>

                                      <td>
                                        <div id="divtengiong_{{$trid}}" class="form-group">
                                          <input id="inptengiong_{{$trid}}" type="text" name="tengiong[]" class="form-control" value="{{$ChiTiet->tendonggiong}}" placeholder="Tên giống" readonly="true">
                                          <span class="help-block">
                                              <strong id="tengiong_helpblock_{{$trid}}"></strong>
                                          </span>
                                        </div>
                                      </td>
                                     
                                      <td>
                                        <div id="divcapgiong_{{$trid}}" class="form-group">
                                          <input id="inpcapgiong_{{$trid}}" type="text" name="capgiong[]" value="{{$ChiTiet->phancapgiong_id ? $ChiTiet->phancapgiong->tenphancapgiong : ''}}" class="form-control" placeholder="Cấp giống" readonly="true">
                                          <span class="help-block">
                                              <strong id="capgiong_helpblock_{{$trid}}"></strong>
                                          </span>
                                        </div>
                                      </td>

                                      <td>
                                        <div id="divnguongoc_{{$trid}}" class="form-group">
                                          <input id="inpnguongoc_{{$trid}}" type="text" name="nguongoc[]" value="{{$ChiTiet->nguongoc}}" class="form-control" placeholder="Nguồn gốc" readonly="true">
                                          <span class="help-block">
                                              <strong id="nguongoc_helpblock_{{$trid}}"></strong>
                                          </span>
                                        </div>
                                      </td>

                                      <!-- <td>
                                        <div id="divluong_{{$trid}}" class="form-group">
                                          <input id="inpluong_{{$trid}}" type="number" name="luongdenghi[]" value="{{$ChiTiet->luongdenghi}}" class="form-control" placeholder="hạt (g)">
                                          <span class="help-block">
                                              <strong id="luong_helpblock_{{$trid}}"></strong>
                                          </span>
                                        </div>
                                      </td> -->

                                      <td>
                                        <div id="divtylenaymam_{{$trid}}" class="form-group">
                                          <input id="inptylenaymam_{{$trid}}" type="number" name="luongthatxuat[]" class="form-control" value="{{$ChiTiet->luongthatxuat}}" placeholder="%">
                                          <span class="help-block">
                                              <strong id="tylenaymam_helpblock_{{$trid}}"></strong>
                                          </span>
                                        </div>
                                      </td>
                                      <!-- <td class="text-center">
                                        <a class="btn btn-warning btn-remove-row" title="Xóa bỏ dòng này"><i class="fa fa-remove"></i></a>
                                      </td> -->
                                    </tr>
                                  @endforeach
                                @else
                                  <tr id="tr1">
                                    <th id="stt_tr1" scope="row">1</th>

                                    <td>
                                      <div id="divmalo_tr1" class="form-group">
                                        <input id="inpmalo_tr1" type="text" name="malo[]" class="form-control autocompletemalo" placeholder="Mã lô">
                                        <span class="help-block">
                                            <strong id="malo_helpblock_tr1"></strong>
                                        </span>
                                      </div>
                                    </td>

                                    <td id="td1">
                                      <div id="divtengiong_tr1" class="form-group">
                                        <input id="inptengiong_tr1" type="text" name="tengiong[]" class="form-control" placeholder="Tên giống" readonly="true">
                                        <span class="help-block">
                                            <strong id="tengiong_helpblock_tr1"></strong>
                                        </span>
                                      </div>
                                    </td>
                                   
                                    <td>
                                      <div id="divcapgiong_tr1" class="form-group">
                                        <input id="inpcapgiong_tr1" type="text" name="capgiong[]" class="form-control" placeholder="Cấp giống" readonly="true">
                                        <span class="help-block">
                                            <strong id="capgiong_helpblock_tr1"></strong>
                                        </span>
                                      </div>
                                    </td>

                                    <td>
                                      <div id="divnguongoc_tr1" class="form-group">
                                        <input id="inpnguongoc_tr1" type="text" name="nguongoc[]" class="form-control" placeholder="Nguồn gốc" readonly="true">
                                        <span class="help-block">
                                            <strong id="nguongoc_helpblock_tr1"></strong>
                                        </span>
                                      </div>
                                    </td>

                                    <!-- <td>
                                      <div id="divluong_tr1" class="form-group">
                                        <input id="inpluong_tr1" type="number" name="luong[]" class="form-control" placeholder="hạt (g)">
                                        <span class="help-block">
                                            <strong id="luong_helpblock_tr1"></strong>
                                        </span>
                                      </div>
                                    </td> -->

                                    <td>
                                      <div id="divtylenaymam_tr1" class="form-group">
                                        <input id="inptylenaymam_tr1" type="number" name="tylenaymam[]" class="form-control" placeholder="%">
                                        <span class="help-block">
                                            <strong id="tylenaymam_helpblock_tr1"></strong>
                                        </span>
                                      </div>
                                    </td>
                                    <td class="text-center">
                                      <a class="btn btn-warning btn-remove-row" title="Xóa bỏ dòng này"><i class="fa fa-remove"></i></a>
                                    </td>
                                  </tr>
                                @endif
                              @endif
                            </tbody>

                           <!--  <tfoot>
                              <tr>
                                <td colspan="8">
                                  <a id="btn-addseedrow" class="btn btn-primary btn-block">Thêm mới</a>
                                </td>
                              </tr>
                            </tfoot> -->

                        </table>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">
                      <a href="{{route('storeexportexportfile', ['id' => $XuatKho->id])}}" class="btn btn-primary"><i class="fa fa-download"> PHIẾU XUẤT KHO</i></a>
                      <!-- <button class="btn btn-primary" type="button">Cancel</button>
                      <button class="btn btn-primary" type="reset">Reset</button>
                      <button type="submit" class="btn btn-success">Submit</button> -->
                      <!-- <button class="btn btn-warning" type="reset"><i class="fa fa-refresh"></i> Làm lại </button>
                      <button type="submit" id="btnsave_storeexport" class="btn btn-success"><i class="fa fa-save"></i> Lưu </button> -->
                    </div>
                  </div>
                </div>
              @else
                <div class="row">
                  <h3>Không có thông tin (dữ liệu)!</h3>
                </div>
              @endif

              <div class="ln_solid"></div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
<!-- /page content -->

@section('javascript')
  @parent

  <!-- Scripts for StoreImport -->
  <script src="{{URL::asset('js/storeexport.js')}}"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
 <!-- jQuery autocomplete -->
    <script src="{{URL::asset('themes/gentelella/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>


  <script>
    
      var path_localhost =  "{{URL::to('/')}}" + "/";
      
      $('#myDatepickerNgayThuHoach').datetimepicker({
          format: 'DD/MM/YYYY',
          ignoreReadonly: true,
          allowInputToggle: true
      });

      $('#myDatepickerNgayXuatKho').datetimepicker({
          format: 'DD/MM/YYYY',
          ignoreReadonly: true,
          allowInputToggle: true
      });
      
  </script>
@endsection