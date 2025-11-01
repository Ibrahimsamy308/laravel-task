<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteProductProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'name' => 'admin'
    ],
    function () {

        Route::group(['prefix' => 'dashboard'], function () {
            Auth::routes();
            // cancel login and register for front temporarly
            Route::get('/login', function () {
                return redirect()->route('admin.login-view');
            });

            Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
            Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login')->middleware('guest:admin');
            Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm'])->name('admin.register-view');
            Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'createAdmin'])->name('admin.register');
            Route::group(['middleware' => ['auth:admin']], function () {

                Route::get('/', function () {
                    return view('admin.home');
                })->name('dashboard');

            Route::resource('roles', RoleController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('contacts', ContactController::class);
            Route::resource('tests', ImageController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('users', UserController::class);
            
            Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
         
            Route::get('/dashboard', function () {
                return view('admin.home');
            });

            Route::put('/setting', 'App\Http\Controllers\Admin\SettingController@setting')->name('setting');
            Route::get('/setting/edit', 'App\Http\Controllers\Admin\SettingController@editSetting')->name('edit.setting');
            Route::get('/dark-toggle', 'App\Http\Controllers\Admin\SettingController@toggleDarkMode')->name('dark.toggle');

        });
    });
}
);