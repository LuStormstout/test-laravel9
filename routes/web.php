<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('product')->group(function () {
    // 商品列表页面
    Route::get('index', [ProductController::class, 'index'])->name('product.index');

    // 展示创建商品表单
    Route::get('create', [ProductController::class, 'showCreateForm']);

    // 处理产品创建请求
    Route::post('create', [ProductController::class, 'create'])->name('product.create');
});
