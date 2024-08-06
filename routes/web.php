<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
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

//Route::get('/', function () {
////    return view('welcome');
//
//    // lấy tất cả dữ liệu có trong bảng
////    $data = DB::table('categories')
////        ->get();
//
//    // lấy dữ liệu theo cột mong muốn
////    $data = DB::table('categories')
////        ->select('id','name')
////        ->get();
//
//    // lấy dữ liệu theo điều kiện where
////    $data=DB::table('categories')
////        ->select('id','name')
////        ->where('id',7)
////        ->get();
//
//    // like: so sánh tương đối
////    $data=DB::table('categories')
////        ->select('id','name')
////        ->where('name','like','%S%')
////        ->get();
//
//    //and: "và": thỏa mãn tất cả các điều kiện
////    $data=DB::table('categories')
////        ->select('id','name')
////        ->where('id',9)
////        ->where('name','like','%S%')
////        ->get();
//
//    //or:"hoặc": thỏa mãn 1 trong các điều kiện
////    $data=DB::table('categories')
////        ->select('id','name')
////        ->orWhere('id',9)
////        ->orWhere('name','like','%S%')
////        ->get();
//
//    //not: phủ định
//    $data=DB::table('categories')
//        ->select('id','name')
//        ->whereNot('name','like','%S%')
//        ->get();
//    return $data;
//});


//Route::get('/',function (){
//   // truy vấn để lấy tất cả
////    $data = Post::all();
////    $data = Post::get();
////    dd($data);
//    // where
////    $data = Post::where('id',2)->get();
////    dd($data);
//
//    // thêm dữ liệu
//    // cách 1:
////    $post = new Post();
////    $post->title = "bài viết số 3";
////    $post->content = "nội dung bài viết số 3";
////    $post->save();
//
//    // cách 2:
////    $post = Post::query()->create([
////       'title'=>"Bài viết số 4",
////       'content'=>"Nội dung bài viết số 4",
////       'name'=>"kientc",
////    ]);
////    dd($post);
//
//    //sửa
//    //cách 1:
//    $post = Post::query()->find(4);
//    $post->title = "ABC";
//    $post->save();
//
//    // cách 2:
//    $post = Post::query()->where('id',5)->update([
//        'title'=>"Bài viết số n",
//        'content'=>"nội dung bài viết số n"
//    ]);
//    dd($post);
//
//    // xóa
//    $post = Post::query()->where('id',3)->delete();
//    dd($post);
//
//});

//Route::get('/products',[\App\Http\Controllers\ProductController::class,'index'])
//    ->name('product.index');

Route::controller(\App\Http\Controllers\ProductController::class)
    ->name('products.')
    ->prefix('products/')
//    ->middleware('admin')
    ->group(function (){
        Route::get('/home','home')->name('home');
        Route::get('/','index')->name('index'); //hiển thị danh sách
        Route::get('create','create')->name('create'); //hiển thị form thêm
        Route::post('store','store')->name('store'); //thực hiện chức năng thêm
        Route::get('edit/{id}','edit')->name('edit') // hiển thị form sửa
            ->where('id','[0-9]+');// id chỉ cho phép là số
        Route::put('update/{id}','update')->name('update') //thực hiện chức năng sửa
            ->where('id','[0-9]+');
        Route::delete('destroy/{id}','destroy')->name('destroy') // thực hiện xóa
            ->where('id','[0-9]+');
    });

Route::controller(\App\Http\Controllers\UserController::class)
    ->group(function (){
       Route::get('register','register')->name('register');
       Route::post('register','postRegister')->name('postRegister');
       Route::get('login','login')->name('login');
       Route::post('login','postLogin')->name('postLogin');
       Route::post('logout','sigOut')->name('sigOut');
    });
    Route::controller(\App\Http\Controllers\UserController::class)
    ->name('users.')
    ->prefix('users/')
    ->group(function (){
        Route::get('/','index')->name('index'); //hiển thị danh sách
        Route::delete('destroy/{id}','destroy')->name('destroy') // thực hiện xóa
        ->where('id','[0-9]+');
        Route::get('edit/{id}','edit')->name('edit') // hiển thị form sửa
        ->where('id','[0-9]+');// id chỉ cho phép là số
    Route::put('update/{id}','update')->name('update') //thực hiện chức năng sửa
        ->where('id','[0-9]+');
    });
    Route::controller(CategoryController::class)
    ->name('categories.')
    ->prefix('categories/')
    ->group(function (){
        Route::get('/','index')->name('index'); //hiển thị danh sách
        Route::get('create','create')->name('create'); //hiển thị form thêm
        Route::post('store','store')->name('store'); //thực hiện chức năng thêm
        Route::get('edit/{id}','edit')->name('edit') // hiển thị form sửa
            ->where('id','[0-9]+');// id chỉ cho phép là số
        Route::put('update/{id}','update')->name('update') //thực hiện chức năng sửa
            ->where('id','[0-9]+');
        Route::delete('destroy/{id}','destroy')->name('destroy') // thực hiện xóa
            ->where('id','[0-9]+');
    });
    Route::controller(\App\Http\Controllers\BannerController::class)
    ->name('banners.')
    ->prefix('banners/')
    ->group(function (){
        Route::get('/','index')->name('index'); //hiển thị danh sách
        Route::get('create','create')->name('create'); //hiển thị form thêm
        Route::post('store','store')->name('store'); //thực hiện chức năng thêm
        Route::get('edit/{id}','edit')->name('edit') // hiển thị form sửa
            ->where('id','[0-9]+');// id chỉ cho phép là số
        Route::put('update/{id}','update')->name('update') //thực hiện chức năng sửa
            ->where('id','[0-9]+');
        Route::delete('destroy/{id}','destroy')->name('destroy') // thực hiện xóa
            ->where('id','[0-9]+');
            Route::get('show/{id}','show')->name('show');
    });
