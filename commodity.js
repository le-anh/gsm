var uRL = uRLBase + "Commodity";

var dsQRCodeAvaliable;

/*
 * Show in Select Manufacturer
 */
function showSelectManufacturer() {
  var msg = callAPI(uRLBase + "Manufacturer", "GET");
  $('#commodity-owner').html('<option value=""> --- Chọn nhà sản xuất ---</option>');

  if(msg)
  {
    $.each(msg, function(key, value){
      var newRow = '<option value="' + value['$class'] + '#' +value['tradeId'] + '">' + value['companyName'] + '</option>';
      $('#commodity-owner').append(newRow);
    });
  }
}
/*
 * End Show in Select Manufacturer
 */

/*
 * List Commodity
 */
function getCommodityAPI() {
  var msg = callAPI(uRL, "GET");
  if(msg)
  {
    var STT = 0;
    $.each(msg, function(key, value){
      STT++;
      var newRow = '<tr>';
        newRow += '<td class="text-center">' + STT + '</td>';
        newRow += '<td class="text-center">' + value['tradingSymbol'] + '</td>';
        newRow += '<td>' + value['name'] + '</td>';
        newRow += '<td>' + value['description'] + '</td>';
        // newRow += '<td class="text-right">' + value['unitPrice'] + '</td>';
        newRow += '<td>' + getOnwer(value.owner) + '</td>';
        // newRow += '<td class="text-center">' +
        //             '<a href="' + urlRouteEditCommodity + '/' + value['tradingSymbol'] + '" class="btn btn-warning"> <i class="fa fa-edit"></i> </a>' +
        //             '<a href="" class="btn btn-danger btn-remove" idCommodity="' + value['tradingSymbol'] + '" nameCommodity="' + value['name'] + '"> <i class="fa fa-remove"></i> </a>' +
        //           '</td>';

      newRow += '</tr>';
      $('#tbody-commodity').append(newRow);
    });

    $('.btn-remove').click(function(e){

      DeleteCommodity(e, $(this).attr('idCommodity'), $(this).attr('nameCommodity'));

      e.preventDefault();
      e.stopPropagation();
    });
  }
  else
  {
    alert("Không lấy được dữ liệu từ hệ thống!");
  }
}
/*
 * End List Commodity
 */

/*
 * Get Owner Commodity
 */
function getOnwer(str) {
  var lenghtNameSpace = 23;
  var indexCharShap = str.indexOf('#');

  var idOwner = str.substr(indexCharShap + 1, str.lenght);
  var nameClass = str.substr(lenghtNameSpace, indexCharShap - lenghtNameSpace);

  var uRLManufacturer = uRLBase + '/' + nameClass +'/' + idOwner;

  return callAPI(uRLManufacturer, "GET").companyName;
}

function getOnwerID(str) {
  var indexCharShap = str.indexOf('#');

  var idOwner = str.substr(indexCharShap + 1, str.lenght);

  return idOwner;
}
/*
 * End Get Owner Commodity
 */


/*
 * Selected change QR Code Bar Parcel
 */
$('#qrcodebar').change(function(e){

  if(!isEmpty($('#qrcodebar').val()))
  {
    dsQRCodeAvaliable =  callAPI(urlRouteQRCodeAvaliable + '/' + $('#qrcodebar').val(), "GET");
    var str = "Số thứ tự tem còn: ";
    var i = 0;
    $.each(dsQRCodeAvaliable, function(key, value){
      if(i==0)
        str += value.stt;
      else
        str += ', ' + value.stt;

      i++;
    });

    if(i == 0)
    {
      $('#qrcodebaravaliable').html("Lô tem này đã hết tem");
    }
    else
    {
      $('#qrcodebaravaliable').html(str);
    }

  }

  e.preventDefault();
  e.stopPropagation();

});
/*
 * End Selected change QR Code Bar Parcel
 */

/*
 * Add Commodity
 */
$('.btn-save').click(function(e){
  if(validateDataAddCommodity())
  {
    alert(" Lỗi dữ liệu!\n Vui lòng kiểm tra lại những ô thông báo lỗi màu đỏ.");
    e.preventDefault();
    e.stopPropagation();
  }
  else
  {
    if(validateQRCodeToAddForCommodity())
    {
      alert(" Lỗi dữ liệu!\n Vui lòng kiểm tra lại những ô thông báo lỗi màu đỏ.");
      e.preventDefault();
      e.stopPropagation();
    }
    else
    {
      postAddCommodityAPI();
      e.preventDefault();
      e.stopPropagation();
    }
    
    e.preventDefault();
    e.stopPropagation();
  }
});



function validateDataAddCommodity() {
  var hasError = false;

  var hasErrorQRCodeFromTo = false;
  
  // QR Code Bar Serial From vs QR Code Bar Serial To
  if(!isEmpty($('#qrcodebar-serial-to').val()) && !isEmpty($('#qrcodebar-serial-to').val()) && parseInt($('#qrcodebar-serial-to').val()) < parseInt($('#qrcodebar-serial-from').val()))
  {
    $('#div-qrcodebar-serial').addClass('has-error');
    $('#help-error-qrcodebar-serial').html("Số tem kết thúc phải nhỏ hơn hoặc bằng số tem bắt đầu");
    hasError = true;
    hasErrorQRCodeFromTo = true;
  }
  else
  {
    $('#div-qrcodebar-serial').removeClass('has-error');
    $('#help-error-qrcodebar-serial').html("");
  }

  // QR Code Bar Serial To
  if(isEmpty($('#qrcodebar-serial-to').val()))
  {
    $('#div-qrcodebar-serial-to').addClass('has-error');
    $('#help-error-qrcodebar-serial-to').html("Vui nhập số tem kết thúc");
    hasError = true;
  }
  else
  {
    $('#div-qrcodebar-serial-to').removeClass('has-error');
    $('#help-error-qrcodebar-serial-to').html("");

    if(isExist(dsQRCodeAvaliable, $('#qrcodebar-serial-to').val()))
    {
      $('#div-qrcodebar-serial-to').removeClass('has-error');
      $('#help-error-qrcodebar-serial-to').html("");
    }
    else
    {
      $('#div-qrcodebar-serial-to').addClass('has-error');
      $('#help-error-qrcodebar-serial-to').html("Số thứ tự không có trong dãy tem còn lại");
      hasError = true;
    }
  }

  // QR Code Bar Serial From
  if(isEmpty($('#qrcodebar-serial-from').val()))
  {
    $('#div-qrcodebar-serial-from').addClass('has-error');
    $('#help-error-qrcodebar-serial-from').html("Vui nhập số tem bắt đầu");
    hasError = true;
  }
  else
  {
    $('#div-qrcodebar-serial-from').removeClass('has-error');
    $('#help-error-qrcodebar-serial-from').html("");

    if(isExist(dsQRCodeAvaliable, $('#qrcodebar-serial-from').val()))
    {
      $('#div-qrcodebar-serial-from').removeClass('has-error');
      $('#help-error-qrcodebar-serial-from').html("");
    }
    else
    {
      $('#div-qrcodebar-serial-from').addClass('has-error');
      $('#help-error-qrcodebar-serial-from').html("Số thứ tự không có trong dãy tem còn lại");
      hasError = true;
    }
  }

  // QR Code Bar Parcel
  if(isEmpty($('#qrcodebar').val()))
  {
    $('#div-qrcodebar').addClass('has-error');
    $('#help-error-qrcodebar').html("Vui lòng chọn lô tem");
    hasError = true;
  }
  else
  {
    $('#div-qrcodebar').removeClass('has-error');
    $('#help-error-qrcodebar').html("");
  }

  // Commodity Product Date
  if(isEmpty($('#commodity-product-date').val()))
  {
    $('#div-commodity-product-date').addClass('has-error');
    $('#help-error-commodity-product-date').html("Vui lòng nhập ngày sản xuất");
    hasError = true;
  }
  else
  {
    $('#div-commodity-product-date').removeClass('has-error');
    $('#help-error-commodity-product-date').html("");
  }

  // Commodity Quantity
  if(isEmpty($('#commodity-quantity').val()) || parseInt($('#commodity-quantity').val()) == parseInt(0))
  {
    $('#div-commodity-quantity').addClass('has-error');
    $('#help-error-commodity-quantity').html("Vui lòng nhập số lượng sản phẩm - hàng hóa");
    hasError = true;
  }
  else
  {
    $('#div-commodity-quantity').removeClass('has-error');
    $('#help-error-commodity-quantity').html("");

    if(!hasErrorQRCodeFromTo)
    {
      var numQRCodeBar =  ( parseInt($('#qrcodebar-serial-to').val()) - parseInt($('#qrcodebar-serial-from').val()) + 1);
      var commodityQuantity = parseInt($('#commodity-quantity').val());

      if(commodityQuantity > numQRCodeBar)
      {
        $('#div-qrcodebar-serial').addClass('has-error');
        $('#help-error-qrcodebar-serial').html("Số tem không đủ cho số lượng sản phẩm - hàng hóa");
      }
      else
      {

        $('#div-qrcodebar-serial').removeClass('has-error');
        $('#help-error-qrcodebar-serial').html("");

      }
    }
  }

  // Commodity Name
  if(isEmpty($('#commodity-name').val()))
  {
    $('#div-commodity-name').addClass('has-error');
    $('#help-error-commodity-name').html("Vui lòng chọn sản phẩm - hàng hóa");
    hasError = true;
  }
  else
  {
    $('#div-commodity-name').removeClass('has-error');
    $('#help-error-commodity-name').html("");
  }


  
  return hasError;
}

function validateQRCodeToAddForCommodity() {
  var hasError = false;
  var str = "";
  
  var commodityQuantity = parseInt($('#commodity-quantity').val());
  var idParcel = parseInt($('#qrcodebar').val());
  var serialFrom = parseInt($('#qrcodebar-serial-from').val());

  for(var i = 1; i <= commodityQuantity; i++)
  {
    var qrCodeBar = GetQRCodeToCheck(idParcel, (serialFrom + i -1));
    var dataCommodity = callAPI(uRLBase + 'Commodity/' + qrCodeBar, "GET");
    
    var countCommodity = 0;
    $.each(dataCommodity, function(key, val){
      countCommodity++;
    })

    
    if(countCommodity > 0)
    {
      if(str.length == 0)
      {
        str += (serialFrom + i -1);
      }
      else
      {
        str += ", " + (serialFrom + i -1);
      }
    }

  }

  if(str.length > 0)
  {
    $('#div-qrcodebar-serial').addClass('has-error');
    $('#help-error-qrcodebar-serial').html("Các tem: " + str + " đã được sử dụng. Vui lòng chọn dãy tem khác.");
    hasError = true;
  }
  else
  {
    $('#div-qrcodebar-serial').removeClass('has-error');
    $('#help-error-qrcodebar-serial').html("");
  }
  
  return hasError;
}

function isExist(arr, val) {
  var result = false;
  $.each(arr, function(key, value){
    if(value.stt == val)
    {
      result = true;
    }
  });

  return result;
}

function postAddCommodityAPI() {
  var idManufacturerOwner = "1541647911997";

  var commodityQuantity = parseInt($('#commodity-quantity').val());
  var idParcel = parseInt($('#qrcodebar').val());
  var serialFrom = parseInt($('#qrcodebar-serial-from').val());

  var resultPostAdd = true;

  var dataManufacturerOwner =  callAPI(uRLBase + 'Manufacturer/' + idManufacturerOwner, "GET");

  for(var i = 1; i <= commodityQuantity; i++)
  {

    var qrCodeBar = GetQRCode(idParcel, (serialFrom + i -1));
    var commodityCategory = GetComodityCategory($('#commodity-name').val());
    var productDate = $('#commodity-product-date').val();
    var description = "Ngày sản xuất: " + productDate +"<br>Hạn sử dụng: 12 tháng<br>" + commodityCategory.thanhphan;

    try{

      var data = {
        "$class": "agu.fit.lhanh.Commodity",
        "tradingSymbol": qrCodeBar,
        "name": commodityCategory.ten,
        "description": description,
        "quantity": 0,
        "unitPrice": 0,
        "totalPrice": 0,
        "trace": [
          {
            "$class": "agu.fit.lhanh.Trace",
            "timestamp": TimestampMyFormat(),
            "location": dataManufacturerOwner.address,
            "company": "resource:" + dataManufacturerOwner.$class + "#" + dataManufacturerOwner.tradeId
          }
        ],
        "purchaseOrder": {},
        "owner": "resource:" + dataManufacturerOwner.$class + "#" + dataManufacturerOwner.tradeId,
        "issuer": {}
      }


      // var data = {
      //   "$class": "agu.fit.lhanh.Commodity",
      //   "tradingSymbol": qrCodeBar,
      //   "name": commodityCategory.ten,
      //   "description": description,
      //   "quantity": 0,
      //   "trace": [],
      //   "purchaseOrder": {},
      //   "owner": '"resource:agu.fit.lhanh.Manufacturer#1540022021110"',
      //   "issuer": {}
      // }

      if(callAPI(uRL, "POST", data))
      {
        // alert("Đã thêm thành công!");
        // window.location.href = urlRouteListCommodity;
      }
      else
      {
        resultPostAdd = false;
        // alert(" Lỗi trong quá trình thêm mới.\n Vui lòng nhấn F5 (refresh) và nhập lại thông tin.");
      }
    }
    catch(err){
      resultPostAdd = false;
    }
  }

  if(resultPostAdd)
  {
    alert("Đã thêm thành công!");
    window.location.href = urlRouteListCommodity;
  }
  else
  {
    alert(" Lỗi trong quá trình thêm mới.\n Vui lòng nhấn F5 (refresh) và nhập lại thông tin.");
  }
}

function generateIDCommodity()
{
  return timestamp();
  // var msg = callAPI(urlRouteGenerateIDManufucturer, "GET");
  // if(msg)
  // {
  //   return msg;
  // }

  // return "Manufucturer1";
}

function GetQRCode(idParcel, serial)
{
  var qrcode = callAPI(urlRouteGetQRCodeBar + '/' + idParcel + '/' + serial, "GET");
  return qrcode;
}

function GetQRCodeToCheck(idParcel, serial)
{
  var qrcode = callAPI(urlRouteGetQRCodeBarToCheck + '/' + idParcel + '/' + serial, "GET");
  return qrcode;
}

function GetComodityCategory(idCommodityCategory) {
  var commodityCategory = callAPI(urlRouteGetCommodityCategoryInfo + '/' + idCommodityCategory, "GET");
  
  return commodityCategory;
}


/*
 * End Add Manufacturer
 */

/*
 * Edit Manufacturer
 */
function postEditCommodityAPI() {
  var msg = callAPI(uRL + '/' + idManufacturer, "GET");
  if(msg)
  {
    $('#manufacturer-id').val(msg['tradeId']);
    $('#manufacturer-name').val(msg['companyName']);
    $('#manufacturer-address').val(msg['address']['street']);
  }
  else
  {
    alert("Không lấy được dữ liệu từ hệ thống!");
  }
}

$('.btn-save-edit').click(function(e){
  if(validateDataAddManufacturer())
  {
    alert(" Lỗi dữ liệu!\n Vui lòng kiểm tra lại những ô thông báo lỗi màu đỏ.");
    e.preventDefault();
    e.stopPropagation();
  }
  else
  {
    putEditManufacturerAPI();
    e.preventDefault();
    e.stopPropagation();
  }
});

function putEditManufacturerAPI() {

  var data = {
    "$class": "agu.fit.lhanh.Manufacturer",
    "tradeId": getIDManufacturer(),
    "companyName": getNameManufacturer(),
    "address": {
      "$class": "agu.fit.lhanh.Address",
      "longtitude": 0,
      "latitude": 0,
      "city": getTown(),
      "country": "Viet Nam",
      "locality": getDistrict(),
      "region": getProvince(),
      "street": getAddress(),
      "postalCode": "",
      "postOfficeBoxNumber": ""
    }
  }

  if(callAPI(uRL + '/' + idManufacturer, "PUT", data))
  {
    alert("Đã lưu thành công!");
    window.location.href = urlRouteListManufacturer;
  }
  else
  {
    alert(" Lỗi trong quá trình lưu.\n Vui lòng nhấn F5 (refresh) và nhập lại thông tin.");
  }
}
/*
 * End Edit Manufacturer
 */

/*
 * Delete Manufacturer
 */
function DeleteManufacturer(e, idManufacturer, nameManufacturer) {
  if(confirm("Bạn có muốn xóa " + nameManufacturer + "?"))
  {
    deleteManufacturerAPI(idManufacturer);
    e.preventDefault();
    e.stopPropagation();
  }
  else
  {
    e.preventDefault();
    e.stopPropagation();
  }
}

function deleteManufacturerAPI(idManufacturer) {

  if(callAPI(uRL + '/' + idManufacturer, "DELETE") != false)
  {
    alert(" Đã xóa thành công!");
    location.reload();
  }
  else
  {
    alert(" Lỗi trong quá trình xóa.\n Vui lòng nhấn F5 (refresh) và xóa lại.");
  }
}
/*
 * End Delete Commodity
 */

function getIDCommodity() {
  return $('#commodity-id').val();
}

function getNameCommodity() {
  return $('#commodity-name').val();
}

function getDescriptionCommodity() {
  return $('#commodity-description').val();
}

function getPriceCommodity() {
  return $('#commodity-price').val();
}

function getOwnerCommodity() {
  return $('#commodity-owner').val();
}

function getProvince() {
  return $('#commodity_address_province').val();
}

function getDistrict() {
  return $('#commodity_address_province').val();
}

function getTown() {
  return $('#commodity_address_province').val();
}

function getAddress() {
  return $('#Commodity-address').val();
}
