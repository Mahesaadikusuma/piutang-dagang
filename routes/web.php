<?php

use App\Livewire\Admin\Category\CategoryCreate;
use App\Livewire\Admin\Category\CategoryEdit;
use App\Livewire\Admin\Category\CategoryList;
use App\Livewire\Admin\Permission\PermissionList;
use App\Livewire\Admin\Product\ProductCreate;
use App\Livewire\Admin\Product\ProductEdit;
use App\Livewire\Admin\Product\ProductList;
use App\Livewire\Admin\Roles\Index as RolesController;
use App\Livewire\Admin\Setting as AdminSetting;
use App\Livewire\Admin\User\UserList;
use App\Livewire\Dashboard\Setting;
use App\Livewire\HomePage;
use App\Livewire\Page\Checkout;
use App\Livewire\Page\CheckoutPage;
use App\Livewire\Page\DetailPage;
use App\Livewire\Page\Success;
use Illuminate\Support\Facades\Route;


Route::get('/', HomePage::class)->name('homePage');
Route::get('/detail/{product:slug}', DetailPage::class)->name('detailPage');
Route::get('/checkout/{product:slug}', CheckoutPage::class)->name('checkoutPage');

Route::get('/success', Success::class)->name('success');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::group(['prefix' => 'authentication', 'as' => 'authentication.'], function(){
        Route::group(['prefix' => 'roles', 'as' => 'roles.'], function(){
            Route::get('/', RolesController::class)->name('index');
        });

        Route::group(['prefix' => 'permissions', 'as' => 'permissions.'], function(){
            Route::get('/', PermissionList::class)->name('index');
        });

        Route::group(['prefix' => 'users', 'as' => 'users.'], function(){
            Route::get('/', UserList::class)->name('index');
        });
    });
    Route::get('/product', ProductList::class)->name('productList');
    Route::get('/category', CategoryList::class)->name('categoryList');

    Route::get('/category/create', CategoryCreate::class)->name('categoryCreate');
    Route::get('/category/edit/{category:slug}', CategoryEdit::class)->name('categoryEdit');

    Route::get('/product/create', ProductCreate::class)->name('productCreate');
    Route::get('/product/edit/{product:slug}', ProductEdit::class)->name('productEdit');
    
    Route::get('/setting', AdminSetting::class)->name('setting');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
