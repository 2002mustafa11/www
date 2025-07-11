<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceReceiptController;
use App\Http\Controllers\DeviceDeliveryController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\SparePartPurchaseController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AccessorySaleController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\AccessoryShortageController;
use App\Http\Controllers\CuttingController;
use App\Http\Controllers\CuttingUPController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PrintController;
// Route::get('/print-receipt/{id}', [PrintController::class, 'printDeviceReceipt']);
use App\Http\Controllers\MoneyController;

Route::get('/print/device-receipt/{id}', [PrintController::class, 'printDeviceReceipt'])->name('print.deviceReceipt');

Route::resource('money', MoneyController::class);

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
use App\Livewire\UpdateStatus;
Route::get('/update-status/{deviceReceipt}', UpdateStatus::class);


Route::get('/',fn()=>view('welcome'));
Route::resource('technicians', TechnicianController::class);

Route::resource('Cutting', CuttingController::class);
Route::resource('CuttingUP', CuttingUPController::class);

Route::put('device_receipts/{deviceReceipt}/update-status', [DeviceReceiptController::class, 'updateStatus'])->name('device_receipts.updateStatus');
Route::get('/delivery_date', [DeviceReceiptController::class, 'showDeliveryDate'])->name('delivery_date');
Route::get('/receipts', [DeviceReceiptController::class, 'index'])->name('device_receipts.index');
Route::get('/device-receipts/{all?}/{status}', [DeviceReceiptController::class, 'index'])->name('device_receipts.index.all');

Route::get('/receipts/create', [DeviceReceiptController::class, 'create'])->name('receipts.create');
Route::post('/device-receipts', [DeviceReceiptController::class, 'store'])->name('device_receipts.store');
Route::delete('/device-receipts/{deviceReceipt}', [DeviceReceiptController::class, 'destroy'])->name('device_receipts.destroy');

Route::get('/device-receipts/{deviceReceipt}/edit/device', [DeviceReceiptController::class, 'edit'])->name('device_receipts.edit');
Route::put('/device-receipts/{deviceReceipt}', [DeviceReceiptController::class, 'update'])->name('device_receipts.update');

// Route::get('/receipts/{deviceReceipt}/printReceipt', [DeviceReceiptController::class, 'printReceipt'])->name('receipts.printReceipt');
Route::get('/receipts/{deviceReceipt}/viewPDF', [DeviceReceiptController::class, 'viewPDF'])->name('receipts.viewPDF');


Route::get('/delivery/{all?}', [DeviceDeliveryController::class, 'index'])->name('delivery');
Route::get('/delivery/{customer_id}/{device_receipt_id}', [DeviceDeliveryController::class, 'create'])->name('delivery.create');
Route::post('/delivery', [DeviceDeliveryController::class, 'store'])->name('delivery.store');


Route::get('/purchases/{all?}', [SparePartPurchaseController::class, 'index'])->name('purchases.index');
Route::get('/purchase/create', [SparePartPurchaseController::class, 'create'])->name('purchases.create');
Route::post('/purchases', [SparePartPurchaseController::class, 'store'])->name('purchases.store');
Route::put('/purchases/{purchase}', [SparePartPurchaseController::class, 'update'])->name('purchase.update');

Route::get('/spareParts', [SparePartController::class, 'index'])->name('spareParts');




Route::get('/accessory/Sale/{all?}', [AccessorySaleController::class, 'index'])->name('accessorySale.index');
Route::get('/accessorySales/create', [AccessorySaleController::class, 'create'])->name('accessorySale.create');
Route::post('/accessorySale', [AccessorySaleController::class, 'store'])->name('accessorySale.store');
Route::delete('/accessorySale/{id}', [AccessorySaleController::class, 'destroy'])->name('accessorySale.destroy');



Route::prefix('payments')->group(function () {
    Route::get('/index', [PaymentsController::class, 'index'])->name('payments.index');
    Route::get('/create', [PaymentsController::class, 'create'])->name('payments.create');
    Route::post('/', [PaymentsController::class, 'store'])->name('payments.store');
    Route::get('/{id}/edit', [PaymentsController::class, 'edit'])->name('payments.edit');
    Route::put('/{id}', [PaymentsController::class, 'update'])->name('payments.update');
    Route::delete('/{id}', [PaymentsController::class, 'destroy'])->name('payments.destroy');
});


Route::get('/Shortage/index', [AccessoryShortageController::class, 'index'])->name('Shortage.index');
Route::get('/Shortage/create', [AccessoryShortageController::class, 'create'])->name('Shortage.create');
Route::post('/Shortage', [AccessoryShortageController::class, 'store'])->name('Shortage.store');


Route::get('/storet', [AccessoryController::class, 'storet']);
Route::get('/accessorys/create', [AccessoryController::class, 'create'])->name('accessorys.create');
Route::post('/accessorys', [AccessoryController::class, 'store'])->name('accessorys.store');
Route::put('/accessory/{accessory}', [AccessoryController::class, 'update'])->name('accessory.update');
Route::put('/accessoryStock/{accessory}', [AccessoryController::class, 'updateStock'])->name('accessory.updateStock');
Route::get('/accessory/show/{accessory}', [AccessoryController::class, 'show'])
->whereNumber('accessory')
->name('accessory.show');
Route::get('/accessory/{accessory}', [AccessoryController::class, 'edit'])
->whereNumber('accessory')
->name('accessory.edit');
Route::get('/accessorys/type/{type?}', [AccessoryController::class, 'index'])
->where('type', 'screens|kafirs|other')
->name('accessorys');
// Route::put('/accessory/update', [AccessoryController::class, 'update'])->name('accessory.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});

Route::get('/login/admin', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/admin', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register/admin', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register/admin', [AuthController::class, 'register']);

Route::get('/supplier/index', [SupplierController::class, 'index'])->name('supplier.index');


// routes/web.php

use App\Http\Controllers\NotificationController;

Route::get('/notifications/index', [NotificationController::class, 'index']);

Route::get('/review-delivery-date/ajax', [NotificationController::class, 'ReviewDeliveryDate']);

Route::get('/notifications/view',function () {
    return view('notifications');
});


