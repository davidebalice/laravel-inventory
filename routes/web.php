<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\StockController;
use App\Http\Controllers\LangController;

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::middleware(['auth'])->group(function (){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/','Dashboard')->middleware(['auth', 'verified'])->name('dashboard');
    });
    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard','Dashboard')->middleware(['auth', 'verified'])->name('dashboard');
    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');
    });

    Route::controller(SupplierController::class)->group(function(){
        Route::get('/suppliers', 'Supplier')->name('suppliers');
        Route::get('/supplier/add', 'Add')->name('supplier.add');
        Route::get('/supplier/edit/{id}', 'Edit')->name('supplier.edit');
        Route::group(['middleware' => ['demo_mode']], function () {
            Route::post('/supplier/store', 'Store')->name('supplier.store');
            Route::post('/supplier/update', 'Update')->name('supplier.update'); 
            Route::get('/supplier/delete/{id}', 'Delete')->name('supplier.delete');  
        });
    });

    Route::controller(CustomerController::class)->group(function(){
        Route::get('/customers', 'Customer')->name('customers');
        Route::get('/customer/add', 'Add')->name('customer.add');
        Route::post('/customer/store', 'Store')->name('customer.store');
        Route::get('/customer/edit/{id}', 'Edit')->name('customer.edit');   
        Route::get('/customer/delete/{id}', 'Delete')->name('customer.delete');  
        Route::post('/customer/update', 'Update')->name('customer.update'); 
        Route::get('/credit/customer', 'CreditCustomer')->name('credit.customer');
        Route::get('/credit/customer/print/pdf', 'CreditCustomerPrintPdf')->name('credit.customer.print.pdf');
        Route::get('/customer/edit/invoice/{invoice_id}', 'CustomerEditInvoice')->name('customer.edit.invoice');
        Route::post('/customer/update/invoice/{invoice_id}', 'CustomerUpdateInvoice')->name('customer.update.invoice');
        Route::get('/customer/invoice/details/{invoice_id}', 'CustomerInvoiceDetails')->name('customer.invoice.details.pdf');
        Route::get('/paid/customer', 'PaidCustomer')->name('paid.customer');
        Route::get('/paid/customer/print/pdf', 'PaidCustomerPrintPdf')->name('paid.customer.print.pdf');
        Route::get('/customer/wise/report', 'CustomerWiseReport')->name('customer.wise.report');
        Route::get('/customer/wise/credit/report', 'CustomerWiseCreditReport')->name('customer.wise.credit.report');
        Route::get('/customer/wise/paid/report', 'CustomerWisePaidReport')->name('customer.wise.paid.report');
    });

    Route::controller(UnitController::class)->group(function(){
        Route::get('/units', 'Unit')->name('units');
        Route::get('/unit/add', 'UnitAdd')->name('unit.add');
        Route::post('/unit/store', 'Store')->name('unit.store');
        Route::get('/unit/edit/{id}', 'Edit')->name('unit.edit');   
        Route::get('/unit/delete/{id}', 'Delete')->name('unit.delete');  
        Route::post('/unit/update', 'Update')->name('unit.update'); 
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/categories', 'Category')->name('categories');
        Route::get('/category/add', 'Add')->name('category.add');
        Route::post('/category/store', 'Store')->name('category.store');
        Route::get('/category/edit/{id}', 'Edit')->name('category.edit');   
        Route::get('/category/delete/{id}', 'Delete')->name('category.delete');  
        Route::post('/category/update', 'Update')->name('category.update'); 
    });

    Route::controller(ProductController::class)->group(function(){
        Route::get('/products', 'Product')->name('products');
        Route::get('/product/add', 'Add')->name('product.add');
        Route::post('/product/store', 'Store')->name('product.store');
        Route::get('/product/edit/{id}', 'Edit')->name('product.edit');   
        Route::get('/product/delete/{id}', 'Delete')->name('product.delete');  
        Route::post('/product/update', 'Update')->name('product.update'); 
    });

    Route::controller(PurchaseController::class)->group(function(){
        Route::get('/purchase', 'Purchases')->name('purchases');
        Route::get('/purchase/add', 'Add')->name('purchase.add');
        Route::post('/purchase/store', 'Store')->name('purchase.store');
        Route::get('/purchase/edit/{id}', 'Edit')->name('purchase.edit');   
        Route::get('/purchase/delete/{id}', 'Delete')->name('purchase.delete');  
        Route::get('/purchase/approve/{id}', 'Approve')->name('purchase.approve'); 
        Route::get('/purchase/pending', 'Pending')->name('purchase.pending');
        Route::post('/purchase/update', 'Update')->name('purchase.update'); 
        Route::get('/daily/purchase/report', 'DailyPurchaseReport')->name('daily.purchase.report');
        Route::get('/daily/purchase/pdf', 'DailyPurchasePdf')->name('daily.purchase.pdf');
    });

    Route::controller(InvoiceController::class)->group(function(){
        Route::get('/invoices', 'Invoices')->name('invoices');
        Route::get('/invoice/add', 'Add')->name('invoice.add');
        Route::post('/invoice/store', 'Store')->name('invoice.store');
        Route::get('/invoice/delete/{id}', 'Delete')->name('invoice.delete');  
        Route::get('/invoice/pending', 'Pending')->name('invoice.pending');
        Route::get('/invoice/approve/{id}', 'Approve')->name('invoice.approve');  
        Route::post('/approve/store/{id}', 'ApproveStore')->name('approval.store'); 
        Route::get('/invoice/print', 'Print')->name('invoice.print');  
        Route::get('/invoice/print/{id}', 'Pdf')->name('invoice.pdf');
        Route::get('/invoice/daily/report', 'DailyReport')->name('invoice.daily');
        Route::get('/invoice/daily/pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
    });
    
    Route::controller(DefaultController::class)->group(function(){
        Route::get('/get-category', 'GetCategory')->name('get-category');
        Route::get('/get-product', 'GetProduct')->name('get-product');
        Route::get('/get-product-stock', 'GetProductStock')->name('get-product-stock');
        Route::get('/get-product-price', 'GetProductPrice')->name('get-product-price');
    });

    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/report', 'StockReport')->name('stock.report');
        Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf'); 
        Route::get('/stock/supplier/wise', 'StockSupplierWise')->name('stock.supplier.wise'); 
        Route::get('/supplier/wise/pdf', 'SupplierWisePdf')->name('supplier.wise.pdf');
        Route::get('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');
    });
    
});


require __DIR__.'/auth.php';