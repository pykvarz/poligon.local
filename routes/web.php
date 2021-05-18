<?php

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

Route::group(['namespace'=>'App\Http\Controllers\Blog', 'prefix'=>'blog'], function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});


// **** Admin/Categories **** //
Route::group(['prefix'=>'admin/blog'], function (){
    $methods = ['index', 'edit', 'update', 'create', 'store',];
    Route::resource('categories', \App\Http\Controllers\Blog\Admin\CategoryController::class)->only($methods)->names('blog.admin.categories');
    Route::resource('posts', \App\Http\Controllers\Blog\Admin\PostController::class)->except(['show'])->names('blog.admin.posts');
});







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
