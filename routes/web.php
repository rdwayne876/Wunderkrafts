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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){
    
    Route::match(['get','post'], '/', "AdminController@login");

    Route::group(['middleware' =>  ['admin']], function() {
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('settings', 'AdminController@settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('checkCurrentPassword', 'AdminController@checkCurrentPassword');
        Route::post('updateCurrentPassword', 'AdminController@updateCurrentPassword');
        Route::match(['get', 'post'], 'updateInfo', 'AdminController@updateInfo');

        //Sections
        Route::get('sections', 'SectionController@sections');
        Route::post('updateSectionStatus', 'SectionController@updateSectionStatus');
        
        //Categories
        Route::get('categories', 'CategoryController@categories');
        Route::post('updateCategoryStatus', 'CategoryController@updateCategoryStatus');
        Route::match(['get', 'post'], 'addEditCategory/{id?}', 'CategoryController@addEditCategory');
        Route::post('appendLevel', 'CategoryController@appendLevel');
        Route::get('deleteImage/{id}', 'CategoryController@deleteImage');
        Route::get('delete/{id}', 'CategoryController@delete');

        //Products
        Route::get('products', 'ProductController@products');
        Route::post('updateProductStatus', 'ProductController@updateProductStatus');
        Route::get('delete/{id}', 'ProductController@delete');
        Route::match(['get', 'post'], 'products/addedit/{id?}', 'ProductController@addEditProduct');
        
    });
    

});
