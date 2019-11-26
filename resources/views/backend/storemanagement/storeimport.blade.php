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
            <h3>NHẬP KHO<!-- <small>(Nghiệp vụ)</small> --></h3>
          </div>
        </div>
        <div class="row">
          <form action="{{route('post_storeimport')}}" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
            {{csrf_field()}}
            
            @include('layouts.block.message_flash')

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mã nhập </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12" readonly="true" placeholder="Mã nhập kho sẽ được hệ thống tự cấp khi lưu">
              </div>
            </div>

            <div class="form-group{{ $errors->has('tendetaithinghiem') ? ' has-error' : '' }}">
              <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="first-name">Tên đề tài/thí nghiệm <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="tendetaithinghiem" class="form-control col-md-7 col-xs-12" value="{{old('tendetaithinghiem')}}" placeholder="Tên đề tài/thí nghiệm">
                
                @if ($errors->has('tendetaithinghiem'))
                  <span class="help-block">
                      <strong>{{ $errors->first('tendetaithinghiem') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('loaicaytrong') ? ' has-error' : '' }}">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Loại cây <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="loaicaytrong" class="form-control">
                    <option value="0">Chọn loại cây trồng</option>
                    @if(isset($DS_CayTrong))
                      @foreach($DS_CayTrong as $CayTrong)
                        <option value="{{$CayTrong->id}}" {{old('loaicaytrong') == $CayTrong->id ? 'selected = "true"' : ''}}>{{$CayTrong->tencaytrong}}</option>
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
                          <option value="{{$VuSanXuat->id}}" {{(old('vusanxuat')==$VuSanXuat->id)? 'selected="true"' : ''}}>{{$VuSanXuat->tenvusanxuat}}</option>
                        @endforeach
                    </select>
                  @else
                    <p>
                      @foreach($DS_VuSanXuat as $VuSanXuat)
                        &emsp;&emsp;
                        
                        <label for="radvusanxuat{{$VuSanXuat->id}}">{{$VuSanXuat->tenvusanxuat}} </label>
                        
                        <input type="radio" class="flat" name="vusanxuat" id="radvusanxuat{{$VuSanXuat->id}}" value="{{$VuSanXuat->id}}" {{(old('vusanxuat')==$VuSanXuat->id)? 'checked="true"' : ''}}/>
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

            <div class="form-group{{ $errors->has('ngaynhapkho') ? ' has-error' : '' }}">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Ngày nhập kho <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <div class='input-group date' id='myDatepickerNgayNhapKho'>
                        <input type='text' name="ngaynhapkho" class="form-control" value="{{old('ngaynhapkho', date('d/m/Y'))}}" placeholder="date('d/m/Y')" />
                        <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>

                    @if ($errors->has('ngaynhapkho'))
                      <span class="help-block">
                          <strong>{{ $errors->first('ngaynhapkho') }}</strong>
                      </span>
                    @endif
                </div>
              </div>
            </div>
            <!-- <div class="ln_solid"></div> -->
            
            <!-- table thông tin dòng/giống -->
            
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th width="4%">#</th>
                    <th width="12%">Mã dòng/giống</th>
                    <th width="12%">Tên giống/dòng</th>
                    <th width="20%">Cấp giống</th>
                    <th width="15%">Nguồn gốc</th>
                    <th width="15%">Ng.Thu hoạch/Thu thập</th>
                    <th width="10%">Khối lượng (g)</th>
                    <th width="10%">Tỉ lệ nảy mầm</th>
                    <th width="5%"></th>
                  </tr>
                </thead>
                <tbody id="tbody_seeddetail">
                  <tr id="tr0" hidden="true">
                    <th id="stt_tr0" scope="row"></th>

                    <td id="td2">
                      <div id="divmalo_tr0" class="form-group">
                        <input id="inpmalo_tr0" type="text" class="form-control" placeholder="Mã dòng/giống">
                        <span class="help-block">
                            <strong id="malo_helpblock_tr0"></strong>
                        </span>
                      </div>
                    </td>

                    <td id="td1">
                      <div id="divtengiong_tr0" class="form-group">
                        <input id="inptengiong_tr0" type="text" class="form-control" placeholder="Tên dòng/giống">
                        
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
                      <div id="divngaythuhoachthuthap_tr0" class="form-group">

                        <div class='input-group date myDatepicker'>
                          <input id="inpngaythuhoachthuthap_tr0" type='text' class="form-control" placeholder="dd/mm/yyyy" />
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>

                        <input id="inpngaythuhoachthuthap_tr0" type="date" class="form-control" placeholder="Ngày thu hoạch/thu thập">
                        <span class="help-block">
                            <strong id="ngaythuhoachthuthap_helpblock_tr0"></strong>
                        </span>
                      </div>
                    </td>

                    <td id="td6">
                      <div id="divluong_tr0" class="form-group">
                        <input id="inpluong_tr0" type="number" class="form-control" min="0" placeholder="hạt (g)">
                        <span class="help-block">
                            <strong id="luong_helpblock_tr0"></strong>
                        </span>
                      </div>
                    </td>
                    <td id="td7">
                      <div id="divtylenaymam_tr0" class="form-group">
                        <input id="inptylenaymam_tr0" type="number" class="form-control" min="0" placeholder="%">
                        <span class="help-block">
                            <strong id="tylenaymam_helpblock_tr0"></strong>
                        </span>
                      </div>
                    </td>
                    <td id="tr0_td8" class="text-center">
                      <button class="btn btn-warning btn-remove-row" title="Xóa bỏ dòng này"><i class="fa fa-remove"></i></button>
                    </td>
                  </tr>

                  @if(old('tengiong'))
                    @for($i = 0; $i < count(old('tengiong')); $i++)
                      {{$trid = 'tr'.($i+1)}}
                      <tr id="{{$trid}}">
                        <th id="stt_{{$trid}}" scope="row">{{($i+1)}}</th>

                        <td>
                          <div id="divmalo_{{$trid}}" class="form-group">
                            <input id="inpmalo_{{$trid}}" name="malo[]" type="text" class="form-control" value="{{(old('malo.'.$i))}}" placeholder="Mã dòng/giống">
                            <span class="help-block">
                                <strong id="malo_helpblock_{{$trid}}"></strong>
                            </span>
                          </div>
                        </td>

                        <td>
                          <div id="divtengiong_{{$trid}}" class="form-group">
                            <input id="inptengiong_{{$trid}}" type="text" name="tengiong[]" class="form-control" value="{{(old('tengiong.'.$i))}}" placeholder="Tên">
                            
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
                          <div id="divngaythuhoachthuthap_{{$trid}}" class="form-group">

                            <div class='input-group date myDatepicker'>
                              <input id="inpngaythuhoachthuthap_{{$trid}}" type='text' name="ngaythuhoachthuthap[]" class="form-control" value="{{(old('ngaythuhoachthuthap.'.$i))}}" placeholder="dd/mm/yyyy" />
                              <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                            </div>

                            <span class="help-block">
                                <strong id="ngaythuhoachthuthap_helpblock_{{$trid}}"></strong>
                            </span>
                          </div>
                        </td>

                        <td>
                          <div id="divluong_{{$trid}}" class="form-group">
                            <input id="inpluong_{{$trid}}" type="number" name="luong[]" class="form-control" value="{{(old('luong.'.$i))}}" min="0" placeholder="hạt (g)">
                            <span class="help-block">
                                <strong id="luong_helpblock_{{$trid}}"></strong>
                            </span>
                          </div>
                        </td>
                        <td>
                          <div id="divtylenaymam_{{$trid}}" class="form-group">
                            <input id="inptylenaymam_{{$trid}}" type="number" name="tylenaymam[]" class="form-control" value="{{(old('tylenaymam.'.$i))}}" min="0" placeholder="%">
                            <span class="help-block">
                                <strong id="tylenaymam_helpblock_{{$trid}}"></strong>
                            </span>
                          </div>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-warning btn-remove-row" title="Xóa bỏ dòng này"><i class="fa fa-remove"></i></button>
                        </td>
                      </tr>
                    @endfor
                  @else

                    <tr id="tr1">
                      <th id="stt_tr1" scope="row">1</th>

                      <td>
                        <div id="divmalo_tr1" class="form-group">
                          <input id="inpmalo_tr1" type="text" name="malo[]" class="form-control" placeholder="Mã dòng/giống">
                          <span class="help-block">
                              <strong id="malo_helpblock_tr1"></strong>
                          </span>
                        </div>
                      </td>

                      <td id="td1">
                        <div id="divtengiong_tr1" class="form-group">
                          <input id="inptengiong_tr1" type="text" name="tengiong[]" class="form-control" placeholder="Tên dòng/giống">

                          <span class="help-block">
                              <strong id="tengiong_helpblock_tr1"></strong>
                          </span>
                        </div>
                      </td>

                      <td>
                        <div id="divcapgiong_tr1" class="form-group">
                          <select id="selcapgiong_tr1" name="capgiong[]" class="form-control">
                            <option value="0">Chọn cấp</option>
                            @if(isset($DS_PhanCapGiong))
                              @foreach($DS_PhanCapGiong as $PhanCapGiong)
                                <option value="{{$PhanCapGiong->id}}">{{$PhanCapGiong->tenphancapgiong}}</option>
                              @endforeach
                            @endif
                          </select>
                          <span class="help-block">
                              <strong id="capgiong_helpblock_tr1"></strong>
                          </span>
                        </div>
                      </td>

                      <td>
                        <div id="divnguongoc_tr1" class="form-group">
                          <input id="inpnguongoc_tr1" type="text" name="nguongoc[]" class="form-control" placeholder="Nguồn gốc">
                          <span class="help-block">
                              <strong id="nguongoc_helpblock_tr1"></strong>
                          </span>
                        </div>
                      </td>

                      <td>
                        <div id="divngaythuhoachthuthap_tr1" class="form-group">
                          <div class='input-group date myDatepicker'>
                            <input type='text' id="inpngaythuhoachthuthap_tr1" name="ngaythuhoachthuthap[]" class="form-control" value="{{old('ngaythuhoachthuthap')}}" placeholder="dd/mm/yyyy">
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>

                          <span class="help-block">
                              <strong id="ngaythuhoachthuthap_helpblock_tr1"></strong>
                          </span>
                        </div>
                      </td>

                      <td>
                        <div id="divluong_tr1" class="form-group">
                          <input id="inpluong_tr1" type="number" name="luong[]" class="form-control" min="0" placeholder="hạt (g)">
                          <span class="help-block">
                              <strong id="luong_helpblock_tr1"></strong>
                          </span>
                        </div>
                      </td>
                      <td>
                        <div id="divtylenaymam_tr1" class="form-group">
                          <input id="inptylenaymam_tr1" type="number" name="tylenaymam[]" class="form-control" min="0" placeholder="%">
                          <span class="help-block">
                              <strong id="tylenaymam_helpblock_tr1"></strong>
                          </span>
                        </div>
                      </td>
                      <td class="text-center">
                        <button class="btn btn-warning btn-remove-row" title="Xóa bỏ dòng này"><i class="fa fa-remove"></i></button>
                      </td>
                    </tr>

                  @endif

                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="9">
                      <div id="divnullrow" class="form-group">
                        <span class="help-block">
                            <strong id="nullrow_helpblock"></strong>
                        </span>
                      </div>
                      <a id="btn-addseedrow" class="btn btn-primary btn-block">Thêm mới</a>
                    </td>
                  </tr>
                </tfoot>
              </table>
            
            <div class="form-group">
              <div class="col-md-2 col-sm-4 col-xs-6 col-md-offset-5 text-center">
                <input type="file" id="files" name="files" class="text-center">
                <br>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 text-center">

                <button class="btn btn-warning" type="reset"><i class="fa fa-refresh"></i> Làm lại </button>
                <button type="submit" id="btnsave_storeimport" class="btn btn-success"><i class="fa fa-save"></i> Lưu </button>
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
  <!-- Scripts for StoreImport -->
  <script src="{{URL::asset('js/storeimport.js')}}"></script>
  <script src="{{URL::asset('js/xlsx.core.min.js')}}"></script>
  <script src="{{URL::asset('js/moment.min.js')}}"></script>

  <script>
      
      $('.myDatepicker').datetimepicker({
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