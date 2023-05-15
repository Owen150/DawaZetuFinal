<?php

use App\Http\Controllers\AllocatedBudgetController;
use App\Http\Controllers\AuthSuppliersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryTypeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CountyTopUpRequestController;
use App\Http\Controllers\CpController;
use App\Http\Controllers\DrawingRightController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FacilityProductController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceProformaController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductManufacturersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderDetailController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SubCountyTopUpRequestController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierProductCatalogueController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\UserController;
use App\Models\Facility;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect('/login');
});



Route::get('/two-factor/resend', [UserController::class, 'resend'])->name('two_factor_resend')->middleware('auth');

Route::group(['middleware' => ['auth', 'twofactor']], function () {

    Route::get('drawing-rights-data', [DrawingRightController::class, 'indexData'])->name('rights_data');
    Route::get('drawing-rights-facility-data/{id}', [DrawingRightController::class, 'facilityData'])->name('rights_facility_data');
    Route::get('facility-data', [FacilityController::class, 'indexData'])->name('facility_data');
    Route::get('user-data', [UserController::class, 'indexData'])->name('user_data');
    Route::get('suppler-products-data', [SupplierProductController::class, 'indexData'])->name('suppler_products_data');
    Route::get('allocated-budget-data', [AllocatedBudgetController::class, 'indexData'])->name('allocated_budget_data');
    Route::get('purchase-order-data', [PurchaseOrderController::class, 'indexData'])->name('purchase_order_data');
    Route::get('category-type-data', [CategoryTypeController::class, 'indexData'])->name('category_type_data');


    Route::post('suppler-products-details', [PurchaseOrderController::class, 'getProdCodePrice'])->name('suppler_products_details');

    Route::get('purchase-order-receive/{id}', [PurchaseOrderController::class, 'getOrder'])->name('purchase_order_receive');

    Route::get('consolidate', [PurchaseOrderController::class, 'consolidate'])->name('consolidate');

    Route::resource('users', UserController::class);
    Route::resource('drawing-rights', DrawingRightController::class);
    Route::resource('facility', FacilityController::class);
    Route::resource('purchase-order', PurchaseOrderController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('financialYear', FinancialYearController::class);
    Route::resource('suppler-products', SupplierProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('allocated-budget', AllocatedBudgetController::class);
    Route::resource('facilityProducts', FacilityProductController::class);
    Route::resource('productManufacturers', ProductManufacturersController::class);
    Route::resource('profomas', InvoiceProformaController::class);
    Route::resource('category-type', CategoryTypeController::class);
    Route::resource('prescriptions', PrescriptionController::class);
    Route::resource('stock', StockController::class);


    Route::post('/supplier-excel', [SupplierProductController::class, 'excelDownload'])->name('excel_suppliers');
    Route::post('/supplier-excel-upload', [SupplierProductController::class, 'excelUpload'])->name('excel_suppliers_upload');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/verify-two-factor', [UserController::class, 'towFactor'])->name('two_factor')->middleware('auth');
    Route::post('/verify-two-factor/verify', [UserController::class, 'validateRedirectTwoFactor'])->name('two_factor_verify')->middleware('auth');


    Route::resource('purchase-order-detail', PurchaseOrderDetailController::class);
    Route::get('/purchase-order-details/{id}/edit', [PurchaseOrderDetailController::class, 'edit'])->name('editPurchase');
    Route::put('received-purchase-store/{id}', [PurchaseOrderDetailController::class, 'update'])->name('receiveOrder');
    Route::put('receive/facility{id}', [PurchaseOrderController::class, 'receiveOrder'])->name('orderFacility');

    //Profile
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('index_profile');
    Route::resource('profile', ProfileController::class)->except('index');



    Route::get('/facility-home', [HomeController::class, 'facilityDashboard'])->name('facility_home');

    Route::get('/home-scp', [HomeController::class, 'scpDashboard'])->name('scp_home');

    Route::get('/home-co', [HomeController::class, 'coDashboard'])->name('co_home');


    Route::get('/change-password', [UserController::class, 'changePasswordPage'])->name('change_password');
    Route::post('/save-changed-pass', [UserController::class, 'changePassword'])->name('changePasswordMethod');

    Route::get('/purchase-orders', [CpController::class, 'index'])->name('executives_purchase_order');
    Route::get('/purchase-orders/data', [CpController::class, 'getDat'])->name('executives_purchase_order_getdata');


    Route::post('/approve/profoma', [PurchaseOrderController::class, 'approve'])->name('approve');


    Route::get('pos', [PrescriptionController::class, 'pos'])->name('pos');
    Route::get('pos-index', [PrescriptionController::class, 'posIndex'])->name('posIndex');
    Route::get('pos-test/{id}', [PrescriptionController::class, 'posTest'])->name('posTest');
    Route::post('prescriptions/{id}/dispense', [PrescriptionController::class, 'dispense'])->name('dispense');

    Route::get('supplier-product-catalogue', [SupplierProductCatalogueController::class, 'index'])->name('supplier-product-catalogue');
    Route::post('/catalogue-download', [SupplierProductCatalogueController::class, 'excelDownload'])->name('catalogue_download');
    Route::post('/catalogue-upload', [SupplierProductCatalogueController::class, 'excelUpload'])->name('catalogue_upload');

    Route::post('/checkout/{id}', [CheckoutController::class, 'release'])->name('checkout');

    //Sub County Top Up Requests
    Route::resource('sub-county-top-up-requests', SubCountyTopUpRequestController::class);

    //County Top Up Requests
    Route::resource('county-top-up-requests', CountyTopUpRequestController::class);

    //Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings_index');
    Route::post('/county', [SettingsController::class, 'storeCounty'])->name('store_county');
    Route::post('/subcounty', [SettingsController::class, 'storeSubcounty'])->name('store_subcounty');
    Route::post('/ward', [SettingsController::class, 'storeWard'])->name('store_ward');
    Route::post('/location', [SettingsController::class, 'storeLocation'])->name('store_location');

    //File routes
    Route::get('/upload-file', [FileUploadController::class, 'createForm']);
    Route::post('/upload-file', [FileUploadController::class, 'fileUpload'])->name('fileUpload');
});

Route::get('/supplierlogin', [AuthSuppliersController::class, 'index'])->name('index');
Route::post('/supplierlogin', [AuthSuppliersController::class, 'login'])->name('login');
Auth::routes();
