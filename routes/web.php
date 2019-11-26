<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route for test
// Route::get('storeinventorytest', 'StoreInventoryController@index')->name('storeinventorytest');
// End Route for test

Route::get('/', function () {

    // return view('frontend.index');
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

	Route::get('storemanagement', function () {
	    return view('backend.storemanagement.index');
	})->name('storemanagement');

	// Store Import
	Route::get('storeimportlist', 'StoreImportController@index')->name('storeimportlist');
	Route::get('storeimport', 'StoreImportController@create')->name('storeimport');
	Route::post('storeimport', 'StoreImportController@store')->name('post_storeimport');
	Route::get('storeimport/{id}', 'StoreImportController@show')->name('storeimportedit');
	Route::get('storeimport/destroy/{id}', 'StoreImportController@destroy')->name('storeimportdestroy');

	Route::get('storeimport/export/{id?}', 'StoreImportController@exportStoreImport')->name('storeimportexportfile');

	// Route::post('storeimport', 'StoreImportController@store')->name('post_storeimport');
	// End Store Import

	// Store Export
	Route::get('storeexportlist', 'StoreExportController@index')->name('storeexportlist');

	Route::get('storeexport', 'StoreExportController@create')->name('storeexport');
	Route::post('storeexport', 'StoreExportController@store')->name('post_storeexport');
	Route::get('storeexport/{id}', 'StoreExportController@show')->name('storeexportedit');
	Route::get('storeexport/destroy/{id}', 'StoreExportController@destroy')->name('storeexportdestroy');

	Route::get('storeexport/export/{id?}', 'StoreExportController@exportStoreExport')->name('storeexportexportfile');

	// End Store Export

	// Store Inventory - Tồn kho
	Route::get('storeinventory', 'StoreInventoryController@index')->name('storeinventory');
	// End Store Inventory - Tồn kho

	// Store Statistical - Kiểm kê
	Route::get('storestatisticaldata', 'StoreStatisticalController@index')->name('storestatisticaldata');
	// End Store Statistical - Kiểm kê
// });


// Route for ajax
Route::get('getmalo', 'StoreImportDetailController@getMaLo')->name('getmalo');

Route::get('getphieuxuat/{storeimport_id?}', 'StoreExportDetailController@getPhieuXuat')->name('getphieuxuat');

Route::get('getmaphieunhap/{malo?}', 'StoreImportDetailController@getMaPhieuNhap')->name('getphieunhap');

Route::get('getmagionginfo/{magiong?}', 'StoreImportDetailController@getMaGiongInfo')->name('getmagionginfo');

Route::get('getdonggiongthongkebyngay/{tungay?}/{denngay?}', 'StoreInventoryController@InventorySeedByDate')->name('getmagionginfobydate');

Route::get('getdonggiongthongkebytendonggiong/{tendonggiong?}', 'StoreInventoryController@InventorySeedBySeedType')->name('getmagionginfobyseedtype');

Route::get('getdonggiongthongkebymagiong/{magiong?}', 'StoreInventoryController@InventorySeedBySeedID')->name('getmagionginfobyseedid');

Route::get('getdonggiongthongkebymanhapkho/{manhapkho?}', 'StoreInventoryController@InventorySeedByStoreImportID')->name('getmagionginfobystoreimportid');
// End Route for ajax
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
