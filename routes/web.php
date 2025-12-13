<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\InventoryLoginController;
use App\Http\Controllers\InventoryListController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MisreportController;
use App\Http\Controllers\InwardreportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () { 
    return view('welcome');
});*/

// FrontEnd Pages start
Route::get('/', [HomeController::class, 'index']);


// FrontEnd Pages end

Route::get('/login', [AdminUserController::class, 'logintemplate']);
Route::post('/login', [AdminUserController::class, 'login']);
Route::get('/logout', [AdminUserController::class, 'logout']);
Route::get('/forgot-password', [AdminUserController::class, 'forgot_password']);

Route::get('/inventorylogin', [InventoryLoginController::class, 'logintemplate']);
Route::post('/inventorylogin', [InventoryLoginController::class, 'login']);
Route::get('/inventorylist', [InventoryListController::class, 'index']);
Route::post('/inventorylist/search', [InventoryListController::class, 'index']);
Route::get('viewinventory/{id}', 'InventoryListController@viewinventory');
Route::get('/inventory-logout', [InventoryLoginController::class, 'logout']);
// Profile start
Route::get('/my-profile', 'AdminUserController@get_profile');
Route::post('/update-profile', 'AdminUserController@update_profile');
// Profile end

// Settings start
Route::get('/settings', 'SettingsController@get_settings');
Route::post('/update_settings', 'SettingsController@update_settings');
// Settings end

// Inventory user update start
Route::get('/user-inventory', 'UserInventoryController@get_inventory');
Route::post('/user-inventory-update', 'UserInventoryController@update_inventory');
// Inventory user update end

Route::get('/dashboard', [DashboardController::class, 'index']);



Route::get('inventoryfile', 'InventoryController@inventoryfile');
Route::post('upload_inventory_file', 'InventoryController@uploadfile');
Route::get('delinvfile/{id}', 'InventoryController@delinvfile');
Route::get('delpod/{id}', 'InventoryController@delpod');
// Inventory end

// Warehouse start
Route::get('/warehouses', [WarehouseController::class, 'index']);
Route::get('getsupplier/{id}', 'WarehouseController@getsupplier');
Route::resource('warehouses','WarehouseController');
Route::post('/warehouses/update/{id}', 'WarehouseController@update');
Route::post('/warehouses/search', 'WarehouseController@index');
Route::get('warehouseadd', 'WarehouseController@warehouseadd');
Route::get('delcontact/{id}', 'WarehouseController@delcontact');

// Warehouse end

// Supplier start
Route::get('/suppliers', [SupplierController::class, 'index']);
Route::resource('suppliers','SupplierController');
Route::post('/suppliers/update/{id}', 'SupplierController@update');
Route::post('/suppliers/search', 'SupplierController@index');
Route::post('/suppliers/checkmobile', 'SupplierController@checkmobile');
// Supplier end

// Uom start
Route::get('/uom', [UomController::class, 'index']);
Route::resource('uom','UomController');
Route::post('/uom/update/{id}', 'UomController@update');
Route::post('/uom/search', 'UomController@index');
// Uom end

// Category start
Route::get('/categories', [CategoryController::class, 'index']);
Route::resource('categories','CategoryController');
Route::post('/categories/update/{id}', 'CategoryController@update');
Route::post('/categories/search', 'CategoryController@index');
// Category end

// Product start
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/addform', [ProductController::class, 'addproductform']);
Route::resource('products','ProductController');

Route::post('/products/update/{id}', 'ProductController@update');
Route::post('/products/search', 'ProductController@index');
Route::post('/products/addCategory',  'ProductController@addCategory');
Route::post('/products/addUom',  'ProductController@addUom');
Route::post('/products/addSupplier',  'ProductController@addSupplier');
// Product end

// MaterialIn Start
Route::get('/materialin', [MaterialinController::class, 'index']);
Route::post('/materialin/search', 'MaterialinController@index');
Route::get('/materialin/add', 'MaterialinController@add');
Route::get('/materialin/view/{id}', 'MaterialinController@view');
Route::get('/materialin/getproduct/{id}', 'MaterialinController@getproduct');
Route::resource('materialin','MaterialinController');
// MaterialIn End

// MaterialOut Start
Route::get('/materialout', [MaterialoutController::class, 'index']);
Route::post('/materialout/search', 'MaterialoutController@index');
Route::get('/materialout/add', 'MaterialoutController@add');
Route::get('/materialout/view/{id}', 'MaterialoutController@view');
Route::get('/materialout/getproduct/{id}', 'MaterialoutController@getproduct');
Route::get('/materialout/getstock/{id}', 'MaterialoutController@getstock');
Route::resource('materialout','MaterialoutController');
Route::post('/materialout/addDistrict',  'MaterialoutController@addDistrict');
// MaterialOut End

// Stocktransfer Start
Route::get('/stocktransfer', [StocktransferController::class, 'index']);
Route::post('/stocktransfer/search', 'StocktransferController@index');
Route::get('/stocktransfer/add', 'StocktransferController@add');
Route::get('/stocktransfer/view/{id}', 'StocktransferController@view');
Route::get('/stocktransfer/getproduct/{id}', 'StocktransferController@getproduct');
Route::get('/stocktransfer/getstock/{id}', 'StocktransferController@getstock');
Route::resource('stocktransfer','StocktransferController');
Route::post('/stocktransfer/addDistrict',  'StocktransferController@addDistrict');
// Stocktransfer End

// MIS Report Start
Route::get('/misreport', [MisreportController::class, 'index']);
Route::post('/misreport/search', 'MisreportController@index');
Route::post('/misreport/export', 'MisreportController@export')->name('misreport.export');
 Route::post('/misreport/exportpdf','MisreportController@exportpdf')->name('exportpdf'); 
// MIS Report End


// Inward Report Start
Route::get('/inwardreport', [InwardreportController::class, 'index']);
Route::post('/inwardreport/search', 'InwardreportController@index');
Route::post('/inwardreport/export', 'InwardreportController@export')->name('inwardreport.export');
Route::post('/inwardreport/exportpdf','InwardreportController@exportpdf')->name('inwardreport.exportpdf');  
// Inward Report End



// Admin Users start
Route::get('/adminusers', [SubadminController::class, 'index']);
Route::resource('adminusers','SubadminController');
Route::post('/adminusers/update/{id}', 'SubadminController@update');
Route::post('/adminusers/search', 'SubadminController@index');
// Admin Users end

Route::post('uploadimage', 'ShipmentController@uploadimage');
Route::get('delshipmentfile/{id}', 'ShipmentController@delshipmentfile');