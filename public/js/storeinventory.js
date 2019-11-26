// var path_localhost = "http://localhost/gsm_ltg/public/";

/*
 * Search
 */
$('.btnSearchSubmit').click(function(e){

  if(!hasError())
  {
    searchGetData();
  }
 
});

$("input[name='search']:radio").on("change", function() { 
    // alert('hola'); 
    var checkedValue = $("input[name='search']:checked").val();

    switch (checkedValue)
    {
      case '1':
        HiddenAllWithOutID('divSearchByDate');
        break;

      case '2':
        HiddenAllWithOutID('divSearchBySeedType');
        break;
      case '3':
        HiddenAllWithOutID('divSearchBySeedID');
        break;
        
      case '4':
        HiddenAllWithOutID('divSearchByStoreImportID');
        break;
      default:
        break;
    }
});

function HiddenAllWithOutID(id) {
  $('#divSearchByDate').attr('hidden', 'true');
  $('#divSearchBySeedType').attr('hidden', 'true');
  $('#divSearchBySeedID').attr('hidden', 'true');
  $('#divSearchByStoreImportID').attr('hidden', 'true');

  $('#'+id).removeAttr('hidden');
}

function hasError() {
  var checkedValue = $("input[name='search']:checked").val();

    switch (checkedValue)
    {
      case '1':
        return hasErrorSearchByDate();
        break;

      case '2':
        return hasErrorSearchSeedType();
        break;
      case '3':
        return hasErrorSearchSeedID();
        break;
        
      case '4':
      return hasErrorSearchStoreImportID();
        break;
      default:
    }
}

function hasErrorSearchByDate() {
  var from = $("#inpTuNgay").val().split("/");
  var tuNgay = new Date(from[2], from[1] - 1, from[0]);

  var from = $("#inpDenNgay").val().split("/");
  var denNgay = new Date(from[2], from[1] - 1, from[0]);
  if(tuNgay > denNgay)
  {
    $('#divSearchByDate').addClass('has-error');
    $('#SearchByDate-help').html('Ngày không hợp lệ ("Từ ngày" không được lớn hơn "Đến ngày")');
    return true;

  }
  else
  {
    $('#divSearchByDate').removeClass('has-error');
    $('#SearchByDate-help').html('');
    return false;
  }
}

function hasErrorSearchSeedType() {
  var valueSeedType = $("#inpSearchBySeedType").val();
  if(isEmpty(valueSeedType))
  {
    $('#divSearchBySeedType').addClass('has-error');
    $('#SearchBySeedType-help').html('Nhập tên dòng/giống');
    return true;

  }
  else
  {
    $('#divSearchBySeedType').removeClass('has-error');
    $('#SearchBySeedType-help').html('');
    return false;
  }
}

function hasErrorSearchSeedID() {
  var valueSeedType = $("#inpSearchBySeedID").val();
  if(isEmpty(valueSeedType))
  {
    $('#divSearchBySeedID').addClass('has-error');
    $('#SearchBySeedID-help').html('Nhập mã dòng/giống');
    return true;

  }
  else
  {
    $('#divSearchBySeedID').removeClass('has-error');
    $('#SearchBySeedID-help').html('');
    return false;
  }
}

function hasErrorSearchStoreImportID() {
  var valueStoreImportID = $("#inpSearchByStoreImportID").val();
  if(isEmpty(valueStoreImportID))
  {
    $('#divSearchByStoreImportID').addClass('has-error');
    $('#SearchByStoreImportID-help').html('Nhập mã nhập kho');
    return true;

  }
  else
  {
    $('#divSearchByStoreImportID').removeClass('has-error');
    $('#SearchByStoreImportID-help').html('');
    return false;
  }
}

function searchGetData() {
  var checkedValue = $("input[name='search']:checked").val();

    switch (checkedValue)
    {
      case '1':
        getDataByDate();
        break;

      case '2':
        getDataBySeedType();
        break;
      case '3':
        getDataBySeedID();
        break;
        
      case '4':
        getDataByStoreImportID();
        break;
      default:
    }
}

function getDataByDate() {
  var from = $("#inpTuNgay").val().split("/");
  var tuNgay = (from[2] + "-" + from[1] + "-" + from[0]);

  var from = $("#inpDenNgay").val().split("/");
  var denNgay = (from[2] + "-" + from[1] + "-" + from[0]);

  $.ajaxSetup({
        headers: getHeaders()
    });

  $.ajax({
      url: routeGetMaGiongInfoByDate + "/" + tuNgay + "/" + denNgay,
      type: "get",
  })
  .done(function(data) {

    viewDataInTable(data);

  })
  .fail(function() {
    alert( "error" );
  });
      
  // });

}

function getDataBySeedType() {
  var valueSeedType = $("#inpSearchBySeedType").val();

  $.ajaxSetup({
        headers: getHeaders()
    });

  $.ajax({
      url: routeGetMaGiongInfoBySeedType + "/" + valueSeedType,
      type: "get",
  })
  .done(function(data) {

    viewDataInTable(data);

  })
  .fail(function() {
    alert( "error" );
  });
      
  // });

}

function getDataBySeedID() {
  var valueSeedID = $("#inpSearchBySeedID").val();

  $.ajaxSetup({
        headers: getHeaders()
    });

  $.ajax({
      url: routeGetMaGiongInfoBySeedID + "/" + valueSeedID,
      type: "get",
  })
  .done(function(data) {

    viewDataInTable(data);

  })
  .fail(function() {
    alert( "error" );
  });
      
  // });

}

function getDataByStoreImportID() {
  var valueStoreImportID = $("#inpSearchByStoreImportID").val();

  $.ajaxSetup({
        headers: getHeaders()
    });

  $.ajax({
      url: routeGetMaGiongInfoByStoreImportID + "/" + valueStoreImportID,
      type: "get",
  })
  .done(function(data) {

    viewDataInTable(data);

  })
  .fail(function() {
    alert( "error" );
  });
      
  // });

}

function viewDataInTable(data) {
  // $('#tbodydetail').html('');
  var STT = '0';
  $('#datatable-buttons').DataTable().clear();
 
  // $('#tabletest').html('<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"> </table>');
  

  $.each(data, function( key, value ) {
    var newRow = '<tr>';
    newRow += '<td>' + (++STT) + '</td>';
    newRow += '<td>' + value['malo'] + '</td>';
    newRow += '<td>' + value['manhapkho'] + '</td>';
    newRow += '<td>' + value['tendonggiong'] + '</td>';
    newRow += '<td>' + value['tenphancapgiong'] + '</td>';
    newRow += '<td>' + value['nguongoc'] + '</td>';
    newRow += '<td>' + value['luong'] + '</td>';
    newRow += '<td>' + value['tongluongxuat'] + '</td>';
    
    if(parseInt(value['tongluongton']) < 10)
    {
      newRow += '<td class="text-center"><span class="badge bg-red">' + value['tongluongton'] + '</span></td>';
    }
    else
    {
      if(parseInt(value['tongluongton']) < 50)
      {
        newRow += '<td class="text-center"><span class="badge bg-yellow">' + value['tongluongton'] + '</span></td>';
      }
      else
      {
        newRow += '<td class="text-center"><span class="badge bg-green">' + value['tongluongton'] + '</span></td>';
      }
    }

    var columnTon;
    if(parseInt(value['tongluongton']) < 10)
    {
      columnTon = '<span class="badge bg-red">' + value['tongluongton'] + '</span>';
    }
    else
    {
      if(parseInt(value['tongluongton']) < 50)
      {
        columnTon = '<span class="badge bg-orange">' + value['tongluongton'] + '</span>';
      }
      else
      {
        columnTon = '<span class="badge bg-green">' + value['tongluongton'] + '</span>';
      }
    }

    newRow += '</tr>';
    var row = [
      (++STT),
      value['malo'],
      value['manhapkho'],
      value['tendonggiong'],
      value['tenphancapgiong'],
      value['nguongoc'],
      value['luong'],
      value['tongluongxuat'],
      columnTon
    ];

    // $('#tbodydetail').append(newRow);
    $('#datatable-buttons').DataTable().row.add(row);

  });

  if(STT == '0')
  {
    $('#tbodydetail').html('<tr><td colspan="8" class="text-center"><h4> Không tìm thấy thông tin trong hệ thống! </h4></td></tr>');
  }

  // $('#datatable-responsive').fnDraw();
  $('#datatable-buttons').DataTable().draw();
  // $('#tabletest2').DataTable();

}


/*
 * End Search
 */

function isEmpty(str) {
    return(!str || str.length === 0)
}

/*
 * Initial Ajax
 */
function getToken() {
  return $('meta[name="csrf-token"]').attr('content');
}

function getHeaders() {
  return headers = {
    'X-CSRF-TOKEN': getToken()
  }
}

/*
 * End Initial Ajax
 */