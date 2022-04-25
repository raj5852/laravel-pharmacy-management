<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationRackController;
use App\Http\Controllers\DataTableAjaxCRUDController;
use App\Http\Controllers\MedicinePurController;
use App\Http\Controllers\OrderController;

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
    return view('welcome');
});
Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');



//start Rack
Route::get('table-management',[LocationRackController::class,'index'])->name('tablemanagement');
Route::post('table-store',[LocationRackController::class,'store'])->name('tablestore');
Route::post('table-edit',[LocationRackController::class,'edit'])->name('tableedit');
Route::post('table-delete',[LocationRackController::class,'delete'])->name('tabledelete');
//end rack



// start Perchase
Route::get('medicine-purchas',[MedicinePurController::class,'index'])->name('medicinepurchas');
Route::post('medicine-store',[MedicinePurController::class,'store'])->name('medicinestore');
Route::post('medicine-edit',[MedicinePurController::class,'edit'])->name('medicineedit');
Route::post('medicine-delete',[MedicinePurController::class,'delete'])->name('medicinedelete');
Route::post('medicine-perchase',[MedicinePurController::class,'perchase'])->name('medicineperchase');
Route::post('medicine-table-search',[MedicinePurController::class,'search'])->name('medicinetablesearch');
//end perchase




//start Order
Route::get('order-management',[OrderController::class,'index'])->name('ordermanagement');
Route::get('order-add',[OrderController::class,'orderadd'])->name('orderadd');
Route::post('ordermedicine-search',[OrderController::class,'medicinesearch'])->name('medicinesearch');
Route::post('medicine-add',[OrderController::class,'MedicineAdd'])->name('medicineadd');
Route::post('medicine-submit',[OrderController::class,'MedicineSubmit'])->name('medicineSubmit');
Route::get('print-pdf/{id}',[OrderController::class,'PDF_print'])->name('printpdf');
Route::get('order-edit/{id}',[OrderController::class,'Orderedit'])->name('orderedit');
Route::post('order-edit-submit',[OrderController::class,'OrdereditSubmit'])->name('OrdereditSubmit');
Route::post('order-delete',[OrderController::class,'Orderdelete'])->name('Orderdelete');
Route::get('remaining-orders',[OrderController::class,'remainingorders'])->name('remainingorders');
Route::post('remainingedit',[OrderController::class,'remainingedit'])->name('remainingedit');
Route::get('remainingedit-submit',[OrderController::class,'remainingeditsubmit'])->name('remainingeditsubmit');

//
Route::get('demo',[DataTableAjaxCRUDController::class,'demo']);
// Route::view('demo','demo');
