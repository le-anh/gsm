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

    // var row = $('#tr1').html();
    var newrow = 	'<tr id="tr' + (++maxRow) + '">' +
    					'<th id="stt_tr' + (maxRow) + '" scope="row">'+ (++refreshRowNum) + '</th>' +


                        '<td>' +
                            '<div id="divmalo_tr' + (maxRow) + '" class="form-group">' +
                                '<input id="inpmalo_tr' + (maxRow) + '" type="text"  name="malo[]" class="form-control"  placeholder="Mã dòng/giống">' +
                                '<span class="help-block">' +
                                    '<strong id="malo_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                              '</div>' +
                        '</td>' +

                        '<td>' +
                            '<div id="divtengiong_tr' + (maxRow) + '" class="form-group">' +
                                '<input id="inptengiong_tr' + (maxRow) + '" type="text"  name="tengiong[]" class="form-control"  placeholder="Tên dòng/giống">' +
                                '<span class="help-block">' +
                                    '<strong id="tengiong_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                              '</div>' +
    					'</td>' +

                        '<td>' +
                            '<div id="divcapgiong_tr' + (maxRow) + '" class="form-group">' +
                                '<select id="selcapgiong_tr' + (maxRow) + '" name="capgiong[]" class="form-control">' +
                                    $('#selcapgiong_tr0').html() + 
                                '</select>' +
                                '<span class="help-block">' +
                                    '<strong id="capgiong_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                              '</div>' +
                        '</td>' +

    					'<td>' +
                            '<div id="divnguongoc_tr' + (maxRow) + '" class="form-group">' +
                                '<input id="inpnguongoc_tr' + (maxRow) + '" type="text" name="nguongoc[]" class="form-control" placeholder="Nguồn gốc">' +
                                '<span class="help-block">' +
                                    '<strong id="nguongoc_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                              '</div>' +
                        '</td>' +
                        
                        '<td>' +
                            '<div id="divngaythuhoachthuthap_tr' + (maxRow) + '" class="form-group">' +
                                '<div class="input-group date myDatepicker">' +
                                    '<input id="inpngaythuhoachthuthap_tr' + (maxRow) + '" type="text" name="ngaythuhoachthuthap[]" class="form-control" placeholder="dd/mm/yyyy">' +
                                    '<span class="input-group-addon">' +
                                        '<span class="glyphicon glyphicon-calendar"></span>' +
                                    '</span>' +
                                '</div>' +

                                '<span class="help-block">' +
                                    '<strong id="ngaythuhoachthuthap_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                              '</div>' +
    					'</td>' +

    					'<td>' +
    						'<div id="divluong_tr' + (maxRow) + '" class="form-group">' +
                                '<input id="inpluong_tr' + (maxRow) + '" type="number" name="luong[]" class="form-control" min="0" placeholder="hạt (g)">' +
                                '<span class="help-block">' +
                                    '<strong id="luong_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                              '</div>' +
    					'</td>' +

    					'<td>' +
    						'<div id="divtylenaymam_tr' + (maxRow) + '" class="form-group">' +
                                '<input id="inptylenaymam_tr' + (maxRow) + '" type="number" name="tylenaymam[]" class="form-control" min="0" placeholder="%">' +
                                '<span class="help-block">' +
                                    '<strong id="tylenaymam_helpblock_tr' + (maxRow) + '"></strong>' +
                                '</span>' +
                            '</div>' +
    					'</td>' +

    					'<td>' +
    						$('#tr0_td8').html() + 
    					'</td>' +
    				'</tr>';
   	$('#tbody_seeddetail').append(newrow);

    $(".btn-remove-row").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        
        if(confirm("Bạn muốn xóa dòng này?"))
        {
            $(this).closest("tr").remove();  
        }
    });

    $('.myDatepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        ignoreReadonly: true,
        allowInputToggle: true
    });
});

$('#btnsave_storeimport').click(function(e){

    var countRow = 0;
    var hasError = false;

    $("#tbody_seeddetail tr").each(function()
    {
        
        if(this.id != 'tr0')
        {
            countRow++;
            // Kiểm tra giống/dòng
            if(isEmpty($("#inptengiong_"+this.id).val()))
            {
                $('#divtengiong_' + this.id).addClass('has-error');
                $('#tengiong_helpblock_' + this.id).html('Nhập tên');
                hasError = true;
            }
            else
            {
                $('#divtengiong_' + this.id).removeClass('has-error');
                $('#tengiong_helpblock_' + this.id).html('');
            }

            // Kiểm tra mã lô
            if(isEmpty($("#inpmalo_" + (this.id) ).val().trim()))
            {
                $('#divmalo_' + this.id).addClass('has-error');
                $('#malo_helpblock_' + this.id).html('Nhập mã lô');
                hasError = true;
            }
            else
            {
                $('#divmalo_' + this.id).removeClass('has-error');
                $('#malo_helpblock_' + this.id).html('');
            }

            // Cấp giống
            if($("#selcapgiong_" + (this.id) ).val() <= 0 )
            {
                $('#divcapgiong_' + this.id).addClass('has-error');
                $('#capgiong_helpblock_' + this.id).html('Chọn cấp giống');
                hasError = true;
            }
            else
            {
                $('#divcapgiong_' + this.id).removeClass('has-error');
                $('#capgiong_helpblock_' + this.id).html('');
            }

            // Nguồn gốc
            if(isEmpty($("#inpnguongoc_" + (this.id) ).val().trim()))
            {
                $('#divnguongoc_' + this.id).addClass('has-error');
                $('#nguongoc_helpblock_' + this.id).html('Nhập nguồn gốc');
                hasError = true;
            }
            else
            {
                $('#divnguongoc_' + this.id).removeClass('has-error');
                $('#nguongoc_helpblock_' + this.id).html('');
            }

            // Ngày thu hoạch/thu thập
            if(isEmpty($("#inpngaythuhoachthuthap_" + (this.id) ).val().trim()))
            {
                $('#divngaythuhoachthuthap_' + this.id).addClass('has-error');
                $('#ngaythuhoachthuthap_helpblock_' + this.id).html('Nhập ngày theo định dạng dd/mm/yyyy');
                hasError = true;
            }
            else
            {
                var ngayThuHoachThuThapTemp = $("#inpngaythuhoachthuthap_" + (this.id) ).val().split("/");
                var ngayThuHoachThuThap = new Date(ngayThuHoachThuThapTemp[2], ngayThuHoachThuThapTemp[1] - 1, ngayThuHoachThuThapTemp[0]);
                
                if(isDate(ngayThuHoachThuThap))
                {
                    $('#divngaythuhoachthuthap_' + this.id).removeClass('has-error');
                    $('#ngaythuhoachthuthap_helpblock_' + this.id).html('');
                }
                else
                {
                    $('#divngaythuhoachthuthap_' + this.id).addClass('has-error');
                    $('#ngaythuhoachthuthap_helpblock_' + this.id).html('Ngày không đúng, nhập ngày theo định dạng dd/mm/yyyy');
                    hasError = true;
                }
            }

            // Lượng hạt (g)
            if($("#inpluong_" + (this.id) ).val() <= 0)
            {
                $('#divluong_' + this.id).addClass('has-error');
                $('#luong_helpblock_' + this.id).html('Nhập lượng hạt(g)');
                hasError = true;
            }
            else
            {
                $('#divluong_' + this.id).removeClass('has-error');
                $('#luong_helpblock_' + this.id).html('');
            }

            // Tỷ lệ nảy mầm
            if($("#inptylenaymam_" + (this.id) ).val() <= 0)
            {
                $('#divtylenaymam_' + this.id).addClass('has-error');
                $('#tylenaymam_helpblock_' + this.id).html('Nhập tỷ lệ nảy mầm');
                hasError = true;
            }
            else
            {
                $('#divtylenaymam_' + this.id).removeClass('has-error');
                $('#tylenaymam_helpblock_' + this.id).html('');
            }
        }
    });

    if(hasError)
    {
        e.preventDefault();
        e.stopImmediatePropagation();
    }
    else
    {
        if(countRow < 1)
        {
            $('#divnullrow').addClass('has-error');
            $('#nullrow_helpblock').html('Nhấn nút thêm mới để thêm chi tiết thông tin nhập kho: Giống/dòng, mã lô, cấp giống, nguồn gốc, lượng hạt(g), tỉ lệ nảy mầm...');
            e.preventDefault();
            e.stopImmediatePropagation();

        }
        else
        {
            $('#divnullrow').removeClass('has-error');
            $('#nullrow_helpblock').html('');
        }
    }

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

function getToken() {
    return $('meta[name="csrf-token"]').attr('content');
}

function getHeaders() {
    return headers = {
        'X-CSRF-TOKEN': getToken()
    }
}

$(".remove-store-import").click(function(e){

    
    if(confirm("Bạn muốn xóa phiếu nhập kho?"))
    {
        $.ajaxSetup({
            headers: getHeaders()
        });

        $.ajax({
            url: routeGetStoreExportDetail + "/" + $(this).attr('value'),
            type: "get",
            async: false,
            success: function(data){
                if(data.id > 0)
                {
                    alert("Không thể xóa phiếu nhập, vì phiếu nhập có liên quan đến phiếu xuất!")
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            },

            error: function(jqXHR, status, err){
                alert("Lỗi không thể xóa!")

                e.preventDefault();
                e.stopImmediatePropagation();
            },
        });
    }
    else
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

// val format mm/dd/YYYY
function isDate(val) {
    var d = new Date(val);
    return !isNaN(d.valueOf());
}

/*
 * Import excel to grid table
 */

 //Change event to dropdownlist
$(document).ready(function(){
    $('#files').change(handleFile);
});

function handleFile(e)
{
    //Get the files from Upload control
    var files = e.target.files;
    var i, f;
    //Loop through files
    for (i = 0, f = files[i]; i != files.length; ++i) {
        var reader = new FileReader();
        var name = f.name;
        reader.onload = function (e) {
            var data = e.target.result;

            var result;
            var workbook = XLSX.read(data, { type: 'binary' });
            
            var sheet_name_list = workbook.SheetNames;
            var count = 0;
            sheet_name_list.forEach(function (y) { /* iterate through sheets */
                //Convert the cell value to Json
                if(count <= 0)
                {
                    var roa = XLSX.utils.sheet_to_json(workbook.Sheets[y]);
                    if (roa.length > 0) {
                    result = roa;
                    count++;
                    }
                }
            });
            //Get the first column first cell value
            $.each(result, function(key, value){
                // alert(result.length);
            // for(var i = 0; i < result.length; i++)
            // {
                // $.each(value, function(key1, value1){
                //   if(key1 != '__rowNum__')
                //   {
                    addrow(value);
                    // alert(value['Ma_Dong_Giong']);
                //   }
                // });
            // }
            });
        };
        reader.readAsArrayBuffer(f);
    }
}
    
function addrow(value)
{
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

    var newrow = '<tr id="tr' + (++maxRow) + '">' +
            '<th id="stt_tr' + (maxRow) + '" scope="row">'+ (++refreshRowNum) + '</th>' +

            '<td>' +
                '<div id="divmalo_tr' + (maxRow) + '" class="form-group">' +
                    '<input id="inpmalo_tr' + (maxRow) + '" type="text"  name="malo[]" class="form-control" value="' + value['Ma_Dong_Giong'] + '" placeholder="Mã dòng/giống">' +
                    '<span class="help-block">' +
                        '<strong id="malo_helpblock_tr' + (maxRow) + '"></strong>' +
                    '</span>' +
                '</div>' +
            '</td>' +

            '<td>' +
                '<div id="divtengiong_tr' + (maxRow) + '" class="form-group">' +
                    '<input id="inptengiong_tr' + (maxRow) + '" type="text"  name="tengiong[]" class="form-control" value="' + value['Ten_Dong_Giong'] + '"   placeholder="Tên dòng/giống">' +
                    '<span class="help-block">' +
                        '<strong id="tengiong_helpblock_tr' + (maxRow) + '"></strong>' +
                    '</span>' +
                '</div>' +
            '</td>' +

            '<td>' +
                '<div id="divcapgiong_tr' + (maxRow) + '" class="form-group">' +
                    '<select id="selcapgiong_tr' + (maxRow) + '" name="capgiong[]" class="form-control">' +
                        $('#selcapgiong_tr0').html() + 
                    '</select>' +
                    '<span class="help-block">' +
                        '<strong id="capgiong_helpblock_tr' + (maxRow) + '"></strong>' +
                    '</span>' +
                '</div>' +
            '</td>' +

            '<td>' +
                '<div id="divnguongoc_tr' + (maxRow) + '" class="form-group">' +
                    '<input id="inpnguongoc_tr' + (maxRow) + '" type="text" name="nguongoc[]" class="form-control" value="' + value['Nguon_Goc'] + '"  placeholder="Nguồn gốc">' +
                    '<span class="help-block">' +
                        '<strong id="nguongoc_helpblock_tr' + (maxRow) + '"></strong>' +
                    '</span>' +
                '</div>' +
            '</td>' +
                        
            '<td>' +
                '<div id="divngaythuhoachthuthap_tr' + (maxRow) + '" class="form-group">' +
                    '<div class="input-group date myDatepicker">' +
                        '<input id="inpngaythuhoachthuthap_tr' + (maxRow) + '" type="text" name="ngaythuhoachthuthap[]" class="form-control" value="' + moment(value['Ngay_Thu_Hoach_Thu_Thap']).format('DD/MM/YYYY') + '"  placeholder="dd/mm/yyyy">' +
                        '<span class="input-group-addon">' +
                            '<span class="glyphicon glyphicon-calendar"></span>' +
                        '</span>' +
                    '</div>' +

                    '<span class="help-block">' +
                        '<strong id="ngaythuhoachthuthap_helpblock_tr' + (maxRow) + '"></strong>' +
                    '</span>' +
                '</div>' +
            '</td>' +

            '<td>' +
                '<div id="divluong_tr' + (maxRow) + '" class="form-group">' +
                    '<input id="inpluong_tr' + (maxRow) + '" type="number" name="luong[]" class="form-control" min="0" value="' + value['Luong_Hat'] + '"  placeholder="hạt (g)">' +
                    '<span class="help-block">' +
                        '<strong id="luong_helpblock_tr' + (maxRow) + '"></strong>' +
                    '</span>' +
                '</div>' +
            '</td>' +

            '<td>' +
                '<div id="divtylenaymam_tr' + (maxRow) + '" class="form-group">' +
                    '<input id="inptylenaymam_tr' + (maxRow) + '" type="number" name="tylenaymam[]" class="form-control" min="0" value="' + value['Ty_Le_Nay_Mam'] + '"  placeholder="%">' +
                    '<span class="help-block">' +
                        '<strong id="tylenaymam_helpblock_tr' + (maxRow) + '"></strong>' +
                    '</span>' +
                '</div>' +
            '</td>' +

            '<td>' +
                $('#tr0_td8').html() + 
            '</td>' +
        '</tr>';

    $('#tbody_seeddetail').append(newrow);
    $('#selcapgiong_tr'+maxRow).val(value['Cap_Giong']);

    $(".btn-remove-row").click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        
        if(confirm("Bạn muốn xóa dòng này?"))
        {
            $(this).closest("tr").remove();  
        }
    });

    $('.myDatepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        ignoreReadonly: true,
        allowInputToggle: true
    });
}
/*
 * End Import excel to grid table
 */