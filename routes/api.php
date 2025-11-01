<?php


use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VendorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['apiLocalization','cors']], function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);

    Route::get('/vendors', [VendorController::class, 'index']);
    Route::get('/vendor/{id}', [VendorController::class, 'show']);

    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expense/{id}', [ExpenseController::class, 'show']);


    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);

    Route::post('user-block', [UserController::class, 'customerBlock']);
});






Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/social-login', [AuthController::class, 'socialLogin']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/verify/otp', [AuthController::class, 'verifyOtp']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [UserController::class, 'userProfile']);
    Route::post('/profile/update', [UserController::class, 'update']);
    Route::post('/change-password', [UserController::class, 'changePassword']);
    //save lang
    Route::post('update-lang', [UserController::class, 'updateLang']);
    Route::post('update-fcmToken', [UserController::class, 'updateFCMToken']);

    Route::get('/customer/transactions', [UserController::class, 'transactions']);

});