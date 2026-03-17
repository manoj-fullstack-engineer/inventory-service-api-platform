<?php

use Illuminate\Support\Facades\Auth;
// use Illuminate\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StaticHomeController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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



Route::get('/', function () {
	return view('staticHome');
});
Route::post('/send-email', [MailController::class, 'sendMail'])->name('send.email');

Route::get('LoginController', function () {
	return view('auth.login');
});
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/requestTempPassword', [ForgotPasswordController::class, 'tempPasswordRequest'])->name('password.requestTempPassword');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('dashboard', function () {
	return view('layouts.master');
});

Route::group(['middleware' => 'auth'], function () {
	
	// Route to display the change password form
Route::get('password/change', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');

// Route to handle the password change request
Route::post('password/change', [ChangePasswordController::class, 'changePassword'])->name('password.update');

	Route::resource('categories', 'CategoryController');
	Route::get('/apiCategories', 'CategoryController@apiCategories')->name('api.categories');
	Route::get('/exportCategoriesAll', 'CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
	Route::get('/exportCategoriesAllExcel', 'CategoryController@exportExcel')->name('exportExcel.categoriesAll');

	Route::resource('customers', 'CustomerController');
	Route::get('/apiCustomers', 'CustomerController@apiCustomers')->name('api.customers');
	Route::post('/importCustomers', 'CustomerController@ImportExcel')->name('import.customers');
	Route::get('/exportCustomersAll', 'CustomerController@exportCustomersAll')->name('exportPDF.customersAll');
	Route::get('/exportCustomersAllExcel', 'CustomerController@exportExcel')->name('exportExcel.customersAll');

	Route::resource('staffs', 'StaffController');
	Route::get('/apiStaffs', 'StaffController@apiStaffs')->name('api.staffs');
	Route::post('/importStaffs', 'StaffController@ImportExcel')->name('import.staffs');
	Route::get('/exportStaffsAll', 'StaffController@exportStaffsAll')->name('exportPDF.staffsAll');
	Route::get('/exportStaffsAllExcel', 'StaffController@exportExcel')->name('exportExcel.staffsAll');


	Route::resource('contract_products', 'Contract_ProductController');
	Route::get('/apiContract_Products', 'Contract_ProductController@apiContractProducts')->name('api.contract_products');
	Route::get('/exportContract_ProductsAll', 'Contract_ProductController@exportContractProductsAll')->name('exportPDF.contract_productsAll');
	Route::get('/exportContract_ProductsAllExcel', 'Contract_ProductController@exportExcel')->name('exportExcel.contract_productsAll');

	Route::resource('ledgers', 'LedgerController');
	Route::get('/apiLedgers', 'LedgerController@apiLedgers')->name('api.ledgers');
	Route::get('/exportLedgersAll', 'LedgerController@exportLedgersAll')->name('exportPDF.ledgersAll');
	Route::get('/exportLedgersAllExcel', 'LedgerController@exportExcel')->name('exportExcel.ledgersAll');

	Route::resource('reports', 'ReportController');
	Route::get('/apiReports', 'ReportController@apiReports')->name('api.reports');
	// Route::get('/exportLedgersAll', 'LedgerController@exportLedgersAll')->name('exportPDF.ledgersAll');
	// Route::get('/exportLedgersAllExcel', 'LedgerController@exportExcel')->name('exportExcel.ledgersAll');




	Route::resource('sales', 'SaleController');
	Route::get('/apiSales', 'SaleController@apiSales')->name('api.sales');
	Route::post('/importSales', 'SaleController@ImportExcel')->name('import.sales');
	Route::get('/exportSalesAll', 'SaleController@exportSalesAll')->name('exportPDF.salesAll');
	Route::get('/exportSalesAllExcel', 'SaleController@exportExcel')->name('exportExcel.salesAll');

	Route::resource('suppliers', 'SupplierController');
	Route::get('/apiSuppliers', 'SupplierController@apiSuppliers')->name('api.suppliers');
	Route::post('/importSuppliers', 'SupplierController@ImportExcel')->name('import.suppliers');
	Route::get('/exportSupplierssAll', 'SupplierController@exportSuppliersAll')->name('exportPDF.suppliersAll');
	Route::get('/exportSuppliersAllExcel', 'SupplierController@exportExcel')->name('exportExcel.suppliersAll');

	Route::resource('products', 'ProductController');
	Route::get('/apiProducts', 'ProductController@apiProducts')->name('api.products');

	Route::resource('productsOut', 'ProductKeluarController');
	Route::get('/apiProductsOut', 'ProductKeluarController@apiProductsOut')->name('api.productsOut');
	Route::get('/exportProductKeluarAll', 'ProductKeluarController@exportProductKeluarAll')->name('exportPDF.productKeluarAll');
	Route::get('/exportProductKeluarAllExcel', 'ProductKeluarController@exportExcel')->name('exportExcel.productKeluarAll');
	Route::get('/exportProductKeluar/{id}', 'ProductKeluarController@exportProductKeluar')->name('exportPDF.productKeluar');

	Route::resource('productsIn', 'ProductMasukController');
	Route::get('/apiProductsIn', 'ProductMasukController@apiProductsIn')->name('api.productsIn');
	Route::get('/exportProductMasukAll', 'ProductMasukController@exportProductMasukAll')->name('exportPDF.productMasukAll');
	Route::get('/exportProductMasukAllExcel', 'ProductMasukController@exportExcel')->name('exportExcel.productMasukAll');
	Route::get('/exportProductMasuk/{id}', 'ProductMasukController@exportProductMasuk')->name('exportPDF.productMasuk');

	Route::resource('product_returns', 'Product_ReturnsController');
	Route::get('/apiProduct_Returns', 'Product_ReturnsController@apiProduct_Returns')->name('api.Product_Returns');
	Route::get('/exportProductReturnAll', 'Product_ReturnsController@exportProductReturnAll')->name('exportPDF.productReturnAll');
	Route::get('/exportProductReturnAllExcel', 'Product_ReturnsController@exportExcel')->name('exportExcel.productReturnAll');
	Route::get('/exportProductReturn/{id}', 'Product_ReturnsController@exportProductKeluar')->name('exportPDF.productReturn');


	Route::resource('user', 'UserController');
	Route::get('/apiUser', 'UserController@apiUsers')->name('api.users');
});
