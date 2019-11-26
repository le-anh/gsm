// var path_localhost = "http://localhost/gsm/public/";

var errorBool = true;


$( function() {
    // Autocomplete for mã giống
    autocompleteMaGiong();
   
});

// Autocomplete Function
function autocompleteMaGiong() {
    $.ajaxSetup({
        headers: getHeaders()
    });

    $.ajax({
        url: path_localhost + "getmalo",
        type: "get",
        success: function(data){
            $('.autocompletemalo').autocomplete({
                lookup: data,
                onSelect: function (suggestion) {
                    // alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
                    // alert('myselt onSelect:' + $(this).closest('tr').attr('id'));
                    setStoreImpordCode($(this).closest('tr').attr('id'), suggestion.value);
                }
            });

        }
    });
}


$(".autocompletemalo").focusout(function (e) {
    e.preventDefault();
    setStoreImpordCode($(this).closest('tr').attr('id'), $(this).val());
    e.preventDefault();
    e.stopImmediatePropagation();
});

$(".selmaphieunhap").change(function (e) {
    e.preventDefault();
    setAutoValue($(this).closest('tr').attr('id'), $(this).val());
    e.preventDefault();
    e.stopImmediatePropagation();
});

function setStoreImpordCode(id_TR, value_MaGiong) {
    $.ajaxSetup({
        headers: getHeaders()
    });

    // alert(routeGetMaPhieuNhap + "/" + value_MaGiong);
    $.ajax({
        url: routeGetMaPhieuNhap + "/" + value_MaGiong,
        type: "get",
        async: false,
        success: function(data){
            $('#selmaphieunhap_' + id_TR).html('');
            $('#malo_helpblock_' + id_TR).html('');


            switch(data.length)
            {
                case 0:
                    $('#inpluongdenghi_'+id_TR).attr('readonly', 'true');
                    $('#inpluongthatxuat_'+id_TR).attr('readonly', 'true');
                    
                    $('#divmalo_' + id_TR).addClass('has-error');
                    $('#malo_helpblock_' + id_TR).html('Mã giống này đã hết hoặc không có trong hệ thống');
                    break;

                case 1:
                    var row = '<option value="' + data[0].id + '" selected="true">' + data[0].manhapkho + '</option>';
                    $('#selmaphieunhap_' + id_TR).append(row);
                    $('#selmaphieunhap_' + id_TR).attr('readonly', 'true');

                    $('#divmalo_' + id_TR).removeClass('has-error');
                    $('#malo_helpblock_' + id_TR).html('');
                    setAutoValue(id_TR, data[0].id);
                    break;

                default:
                    $('#selmaphieunhap_' + id_TR).append('<option value=""> Chọn mã nhập kho </option>');
                    $.each(data, function(key, value){

                        var row = '<option value="' + value.id + '">' + value.manhapkho + '</option>';
                        $('#selmaphieunhap_' + id_TR).append(row);

                    });
                    $('#divmalo_' + id_TR).removeClass('has-error');
                    $('#malo_helpblock_' + id_TR).html('');
                    break;
            }

            errorBool = false;

        },
        error: function(jqXHR, status, err){
            $('#inptengiong_'+id_TR).val('');
            $('#inpcapgiong_'+id_TR).val('');
            $('#inpnguongoc_'+id_TR).val('');

            $('#inpluongdenghi_'+id_TR).attr('readonly', 'true');
            $('#inpluongthatxuat_'+id_TR).attr('readonly', 'true');
            
            $('#divmalo_' + id_TR).addClass('has-error');
            $('#malo_helpblock_' + id_TR).html('Mã giống không thấy trong hệ thống');

            errorBool = true;
        },
    });
    
}

function setAutoValue(id_TR, storeImportDetailID) {
    $.ajaxSetup({
        headers: getHeaders()
    });

    $.ajax({
        url: routeGetMaGiongInfo + "/" + storeImportDetailID,
        type: "get",
        async: false,
        success: function(data){
            // $('#inpmaphieunhap_'+id_TR).val(data['manhapkho']);
            $('#inptengiong_'+id_TR).val(data['tendonggiong']);
            $('#inpcapgiong_'+id_TR).val(data['tenphancapgiong']);
            $('#inpnguongoc_'+id_TR).val(data['nguongoc']);

            $('#divmalo_' + id_TR).removeClass('has-error');
            $('#malo_helpblock_' + id_TR).html('');

            $('#inpluongdenghi_'+id_TR).removeAttr('readonly', 'true');
            $('#inpluongthatxuat_'+id_TR).removeAttr('readonly', 'true');

            errorBool = false;

        },
        error: function(jqXHR, status, err){
            $('#inptengiong_'+id_TR).val('');
            $('#inpcapgiong_'+id_TR).val('');
            $('#inpnguongoc_'+id_TR).val('');

            $('#inpluongdenghi_'+id_TR).attr('readonly', 'true');
            $('#inpluongthatxuat_'+id_TR).attr('readonly', 'true');
            
            $('#divmalo_' + id_TR).addClass('has-error');
            $('#malo_helpblock_' + id_TR).html('Mã giống không thấy trong hệ thống');

            errorBool = true;
        },
    });
}

function getToken() {
    return $('meta[name="csrf-token"]').attr('content');
}

function getHeaders() {
    return headers = {
            'X-CSRF-TOKEN': getToken()
        }
}

// Add Seed Row
var tr_row = 0;
$('#btn-addseedrow').click(function (e) {
    e.preventDefault();

    var maxRow = 0;
    var refreshRowNum = 0;
    $("#tbody_seeddetail tr").each(function()
    {
        if(this.id != 'tr0')
        {
            $('#stt_'+ this.id).html((++refreshRowNum)); 
            var idRow = this.id;
            var numRow = parseInt(idRow.substring(2, idRow.length));
            if(maxRow < numRow)
            {
                maxRow = numRow;
            }
        }
    });

    var newrow = 	'<tr id="tr' + (++maxRow) + '">' +
    					'<th id="stt_tr' + (maxRow) + '" scope="row">'+ (++refreshRowNum) + '</th>' +

                        '<td>' +
                            '<div id="divmalo_tr' + (maxRow) + '" class="form-group">' +
                                '<input id="inpmalo_tr' + (maxRow) + '" type="text"  name="malo[]" class="form-control autocompletemalo"  placeholder="Mã lô">' +
                                '<span class="help-block">' +
                                    '<strong id="malo_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                              '</div>' +
                        '</td>' +

                        '<td>' +
                            '<div id="divmaphieunhap_tr' + (maxRow) + '" class="form-group">' + 
                                // '<input id="inpmaphieunhap_tr'  + (maxRow) + '" type="text" name="maphieunhap[]" class="form-control" placeholder="Mã phiếu nhập" readonly="true">' +
                                '<select name="maphieunhap[]" id="selmaphieunhap_tr'  + (maxRow) + '"  class="selmaphieunhap form-control">' +
                                '</select>' + 
                                
                                '<span class="help-block">' +
                                    '<strong id="maphieunhap_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +

                        
                      
                            '</div>' +
    					'</td>' +

                        '<td>' +
                            '<div id="divtengiong_tr' + (maxRow) + '" class="form-group">' + 
                                '<input id="inptengiong_tr'  + (maxRow) + '" type="text" name="tengiong[]" class="form-control" placeholder="Tên giống" readonly="true">' +
                                '<span class="help-block">' +
                                    '<strong id="tengiong_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                            '</div>' +
    					'</td>' +

                        '<td>' +
                            '<div id="divcapgiong_tr' + (maxRow) + '" class="form-group">' + 
                                '<input id="inpcapgiong_tr' + (maxRow) + '" type="text" name="capgiong[]" class="form-control" placeholder="Cấp giống" readonly="true">' +
                                '<span class="help-block">' +
                                    '<strong id="capgiong_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                            '</div>' +
                        '</td>' +

    					'<td>' +
                            '<div id="divnguongoc_tr' + (maxRow) + '" class="form-group">' + 
                                '<input id="inpnguongoc_tr' + (maxRow) + '" type="text" name="nguongoc[]" class="form-control" placeholder="Nguồn gốc" readonly="true">' +
                                '<span class="help-block">' +
                                    '<strong id="nguongoc_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                            '</div>' +
    					'</td>' +

    					// '<td>' +
    					// 	'<div id="divluong_tr' + (maxRow) + '" class="form-group">' +
                        //         '<input id="inpluongdenghi_tr' + (maxRow) + '" type="number" name="luong[]" class="form-control" placeholder="hạt (g)">' +
                        //         '<span class="help-block">' +
                        //             '<strong id="luongdenghi_helpblock_tr' + (maxRow) + '"></strong>' +
                        //         '</span>' +
                        //       '</div>' +
    					// '</td>' +

    					'<td>' +
    						'<div id="divtylenaymam_tr' + (maxRow) + '" class="form-group">' +
                                '<input id="inpluongthatxuat_tr' + (maxRow) + '" type="number" name="luongthatxuat[]" class="form-control" placeholder="g(hạt)">' +
                                '<span class="help-block">' +
                                    '<strong id="luongthatxua_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                            '</div>' +
    					'</td>' +

    					'<td>' +
    						$('#tr0_td7').html() + 
    					'</td>' +
    				'</tr>';
   	$('#tbody_seeddetail').append(newrow);


    // event autocomplete
    autocompleteMaGiong();

    $(".autocompletemalo").focusout(function (e) {
        e.preventDefault();
        setStoreImpordCode($(this).closest('tr').attr('id'), $(this).val());
        e.preventDefault();
        e.stopImmediatePropagation();
    });

    $(".selmaphieunhap").change(function (e) {
        e.preventDefault();
        setAutoValue($(this).closest('tr').attr('id'), $(this).val());
        e.preventDefault();
        e.stopImmediatePropagation();
    });

    $(".btn-remove-row").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        
        if(confirm("Bạn muốn xóa dòng này?"))
        {
            $(this).closest("tr").remove();  
        }
    });
});

$('#btnsave_storeexport').click(function(e){
    
    // Kiểm tra xem có cho lưu hay không
    // if(errorBool)
    // {
    //     alert("Lỗi thông tin.\nKiểm tra lại những dòng tô màu đỏ.");
    //     e.preventDefault();
    //     e.stopImmediatePropagation();
    // }
    
    // var countRow = 0;
    // var hasError = false;

    // $("#tbody_seeddetail tr").each(function()
    // {
        
    //     if(this.id != 'tr0')
    //     {
    //         countRow++;
    //         // Kiểm tra giống/dòng
    //         if($("#seltengiong_"+this.id).val() <= 0)
    //         {
    //             $('#divtengiong_' + this.id).addClass('has-error');
    //             $('#tengiong_helpblock_' + this.id).html('Chọn giống/dòng');
    //             hasError = true;
    //         }
    //         else
    //         {
    //             $('#divtengiong_' + this.id).removeClass('has-error');
    //             $('#tengiong_helpblock_' + this.id).html('');
    //         }

    //         // Kiểm tra mã lô
    //         if(isEmpty($("#inpmalo_" + (this.id) ).val().trim()))
    //         {
    //             $('#divmalo_' + this.id).addClass('has-error');
    //             $('#malo_helpblock_' + this.id).html('Nhập mã lô');
    //             hasError = true;
    //         }
    //         else
    //         {
    //             $('#divmalo_' + this.id).removeClass('has-error');
    //             $('#malo_helpblock_' + this.id).html('');
    //         }

    //         // Cấp giống
    //         if($("#selcapgiong_" + (this.id) ).val() <= 0 )
    //         {
    //             $('#divcapgiong_' + this.id).addClass('has-error');
    //             $('#capgiong_helpblock_' + this.id).html('Chọn cấp giống');
    //             hasError = true;
    //         }
    //         else
    //         {
    //             $('#divcapgiong_' + this.id).removeClass('has-error');
    //             $('#capgiong_helpblock_' + this.id).html('');
    //         }

    //         // Nguồn gốc
    //         if(isEmpty($("#inpnguongoc_" + (this.id) ).val().trim()))
    //         {
    //             $('#divnguongoc_' + this.id).addClass('has-error');
    //             $('#nguongoc_helpblock_' + this.id).html('Nhập nguồn gốc');
    //             hasError = true;
    //         }
    //         else
    //         {
    //             $('#divnguongoc_' + this.id).removeClass('has-error');
    //             $('#nguongoc_helpblock_' + this.id).html('');
    //         }

    //         // Lượng hạt (g)
    //         if($("#inpluong_" + (this.id) ).val() <= 0)
    //         {
    //             $('#divluong_' + this.id).addClass('has-error');
    //             $('#luong_helpblock_' + this.id).html('Nhập lượng hạt(g)');
    //             hasError = true;
    //         }
    //         else
    //         {
    //             $('#divluong_' + this.id).removeClass('has-error');
    //             $('#luong_helpblock_' + this.id).html('');
    //         }

    //         // Tỷ lệ nảy mầm
    //         if($("#inptylenaymam_" + (this.id) ).val() <= 0)
    //         {
    //             $('#divtylenaymam_' + this.id).addClass('has-error');
    //             $('#tylenaymam_helpblock_' + this.id).html('Nhập tỷ lệ nảy mầm');
    //             hasError = true;
    //         }
    //         else
    //         {
    //             $('#divtylenaymam_' + this.id).removeClass('has-error');
    //             $('#tylenaymam_helpblock_' + this.id).html('');
    //         }



    //         // // Kiểm tra năm sinh
    //         // if(error_count < Error_Max && (isEmpty($("#anhchiem_dat_namsinh_" + this.id).val())))
    //         // {
    //         //     message += "<br> - Vui lòng nhập năm sinh ở dòng " + row_count + "!";
    //         //     result = true;
    //         //     error_count++;
    //         // }

    //         // // Kiểm tra nghề nghiệp
    //         // if(error_count < Error_Max && (isEmpty($("#anhchiem_inp_nghenghiep_" + this.id).val())))
    //         // {
    //         //     message += "<br> - Vui lòng nhập nghề nghiệp ở dòng " + row_count + "!";
    //         //     result = true;
    //         //     error_count++;
    //         // }

    //         // // Kiểm tra nơi ở
    //         // if(error_count < Error_Max && (isEmpty($("#anhchiem_inp_noio_" + this.id).val())))
    //         // {
    //         //     message += "<br> - Vui lòng nhập nơi ở ở dòng " + row_count + "!";
    //         //     result = true;
    //         //     error_count++;
    //         // }
    //     }
    // });

    // if(hasError)
    // {
    //     e.preventDefault();
    //     e.stopImmediatePropagation();
    // }

    // if(countRow < 1)
    // {
    //     $('#divnullrow').addClass('has-error');
    //     $('#nullrow_helpblock').html('Nhấn nút thêm mới để thêm chi tiết thông tin nhập kho: Giống/dòng, mã lô, cấp giống, nguồn gốc, lượng hạt(g), tỉ lệ nảy mầm...');
    //     e.preventDefault();
    //     e.stopImmediatePropagation();

    // }
    // else
    // {
    //     $('#divnullrow').removeClass('has-error');
    //     $('#nullrow_helpblock').html('');
    // }

    // e.stopImmediatePropagation();
});

$(".btn-remove-row").click(function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    
    if(confirm("Bạn muốn xóa dòng này?"))
    {
        $(this).closest("tr").remove();  
    }
});

$('.remove-store-export').click(function(e){
    if (!confirm("Bạn muốn xóa thông tin xuất kho!"))
    {
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});

function isEmpty(str) {
    if(str == null || str == '')
    {
        return true;
    }
    else
    {
        return false;
    }
}
        