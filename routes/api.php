<?php

use App\Http\Controllers\AboutController as ControllersAboutController;
use App\Http\Controllers\API\ChooseUsController;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\FaqController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\HyperpayController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\ConfigController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\NewsletterController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\API\PageController;
use Illuminate\Http\Request;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\SizeController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\SubcategoryController;
use App\Http\Controllers\API\SupportController;

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

    Route::get('/faqs', [FaqController::class, 'index']);
    Route::get('/faq/{id}', [FaqController::class, 'show']);


    Route::get('/offers', [OfferController::class, 'index']);
    Route::get('/offer/{id}', [OfferController::class, 'show']);

    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/contact/{id}', [ContactController::class, 'show']);

    Route::get('/settings', [SettingController::class, 'index']);

    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/page/{id}', [PageController::class, 'show']);

    Route::get('/banners', [BannerController::class, 'index']);
    Route::get('/banner/{id}', [BannerController::class, 'show']);

    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/policy', [HomeController::class, 'policy']);
    Route::get('/about-us', [AboutController::class, 'index']);

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/flash/sales', [ProductController::class, 'flashSale']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::get('/categoryProducts', [CategoryController::class, 'categoryProducts']);
    Route::get('/categorySubcategories', [CategoryController::class, 'categorySubcategories']);

    Route::get('/sizes', [SizeController::class, 'index']);
    Route::get('/size/{id}', [SizeController::class, 'show']);

    Route::get('/exams', [ExamController ::class, 'index']);
    Route::get('/exam/{id}', [ExamController::class, 'show']);
    
    Route::post('/exam-submissions', [ExamController ::class, 'examSubmit']);

    Route::get('/merchants', [StoreController::class, 'index']);
    Route::get('/merchant/{id}', [StoreController::class, 'show']);

    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/brand/{id}', [BrandController::class, 'show']);
    Route::get('/brandProducts', [BrandController::class, 'brandProducts']);

    Route::get('/subcategories', [SubcategoryController::class, 'index']);
    Route::get('/subcategory/{id}', [SubcategoryController::class, 'show']);
    Route::get('/subcategoryProducts', [SubcategoryController::class, 'subcategoryProducts']);

    Route::get('/instructors', [AdminController::class, 'index']);
    Route::get('/instructor/{id}', [AdminController::class, 'show']);

    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/course/{id}', [CourseController::class, 'show']);

    Route::get('/lessons', [LessonController::class, 'index']);
    Route::get('/lesson/{id}', [LessonController::class, 'show']);

    Route::get('/customers', [UserController::class, 'index']);
    Route::get('/customer/{id}', [UserController::class, 'show']);

    Route::get('/reasons', [OrderController::class, 'reasons']);
    Route::get('/order/status', [OrderController::class, 'orderStatus']);

    Route::get('/search', [ProductController::class, 'search']);

    Route::post('customer-block', [UserController::class, 'customerBlock']);

    Route::get('/chooseUss', [ChooseUsController::class, 'index']);
    Route::get('/chooseUs/{id}', [ChooseUsController::class, 'show']);

    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/service/{id}', [ServiceController::class, 'show']);
});

    // Config
    Route::group([], function () {
        Route::group(['prefix' => 'config'], function () {
            Route::get('/', [ConfigController::class, 'configuration']);
        });
    });



Route::post('/newsletter', [NewsletterController::class, 'store']);
// Route::post('/order', [OrderController::class, 'store']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/message', [MessageController::class, 'store']);





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

    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/checkout', [CartController::class, 'checkout']);
    Route::post('/add/cart', [CartController::class,'addToCart']);
    Route::post('/remove/cart', [CartController::class,'removeItemCart']);
    Route::post('/update/item/count', [CartController::class,'updateItemCount']);
    Route::post('/order/store', [OrderController::class,'store']);
    Route::get('/orders', [OrderController::class,'getOrders']);
    Route::get('/order/{id}', [OrderController::class,'show']);
    Route::get('/orders/status', [OrderController::class,'ordersByStatus']);
    Route::post('/order/{id}/cancel', [OrderController::class,'cancelOrder']);

    // addresses
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::get('/address/{id}', [AddressController::class, 'show']);
    Route::post('/address/store', [AddressController::class, 'store']);
    Route::get('/address/{id}/edit', [AddressController::class, 'edit']);
    Route::post('/address/{id}', [AddressController::class, 'update']);
    Route::delete('/address/{id}', [AddressController::class, 'destroy']);

    Route::get('/customer/transactions', [UserController::class, 'transactions']);

    Route::post('/favorites/toggle/{productId}', [FavoriteController::class, 'toggleFavorite']);
    Route::get('/favorites', [FavoriteController::class, 'getFavorites']);

});


// Hyperpay
Route::group(['prefix' => 'hyperpay'], function () {
    Route::post('checkouts', [HyperpayController::class, 'checkouts']);
    Route::post('payment-status', [HyperpayController::class, 'paymentStatus']);
    Route::post('make-order', [HyperpayController::class, 'order']);
    Route::post('charge-wallet', [HyperpayController::class, 'wallet']);
});