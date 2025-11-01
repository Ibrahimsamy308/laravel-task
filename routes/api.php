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

Route::group(['middleware' => ['apiLocalization', 'cors']], function () {
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/register', [AuthController::class, 'register']);

});

Route::middleware(['auth:sanctum', 'apiLocalization', 'cors'])->group(function () {

    // ===== COMMON USER ROUTES =====
    Route::get('auth/user-profile', [UserController::class, 'userProfile']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    Route::post('auth/profile/update', [UserController::class, 'update']);
    Route::post('auth/change-password', [UserController::class, 'changePassword']);


    // ===== ADMIN ONLY =====
    Route::middleware('role:admin')->group(function () {
        // Vendors
        Route::get('/vendors', [VendorController::class, 'index']);
        Route::get('/vendor/{id}', [VendorController::class, 'show']);
        Route::post('/vendor/store', [VendorController::class, 'store']);
        Route::post('/vendor/{id}', [VendorController::class, 'update']);
        Route::delete('/vendor/{id}', [VendorController::class, 'destroy']);

        // Categories
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/category/{id}', [CategoryController::class, 'show']);
        Route::post('/category/store', [CategoryController::class, 'store']);
        Route::post('/category/{id}', [CategoryController::class, 'update']);
        Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

        // Expenses (admin full access)
        Route::get('/expenses', [ExpenseController::class, 'index']);
        Route::get('/expense/{id}', [ExpenseController::class, 'show']);
        Route::post('/expense/store', [ExpenseController::class, 'store']);
        Route::post('/expense/{id}', [ExpenseController::class, 'update']);
        Route::delete('/expense/{id}', [ExpenseController::class, 'destroy']);

        // Summary report
        Route::get('expenses/summary', [ExpenseController::class, 'summary']);
    });

    // ===== STAFF ONLY =====
    Route::middleware('role:staff')->group(function () {
        // Staff can only view and create expenses
        Route::get('/expenses', [ExpenseController::class, 'index']);
        Route::get('/expense/{id}', [ExpenseController::class, 'show']);
        Route::post('/expense/store', [ExpenseController::class, 'store']);
    });
});