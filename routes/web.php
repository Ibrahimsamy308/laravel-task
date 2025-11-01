<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MessageController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use App\Models\File as ModelsFile;
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


Route::get('/test-image', function () {

    $files = ModelsFile::get();

    foreach ($files as $file) {
        $path = $file->path;

        if (!file_exists($path)) {
            // Just skip files that don't exist (don't abort the whole process)
            continue;
        }

        try {
            // Resize and overwrite the image
            Image::make($path)
                ->resize(2400, 1600, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($path);


        } catch (\Exception $e) {
            // Log error and continue with next image
            \Log::error("Error resizing image {$file->url}: " . $e->getMessage());
            continue;
        }
    }

    return 'All images processed and resized!';
});

Route::get('routes', function () {
    $pattern = '~(?:(\()|(\[)|(\{))(?(1)(?>[^()]++|(?R))*\))(?(2)(?>[^][]++|(?R))*\])(?(3)(?>[^{}]++|(?R))*\})~';
$routeCollection = Route::getRoutes();
echo "<table style='width:100%'>";
    echo "<tr>";
        echo "<td width='10%'>
            <h4>HTTP Method</h4>
        </td>";
        echo "<td width='10%'>
            <h4>Route</h4>
        </td>";
        echo "<td width='10%'>
            <h4>Name</h4>
        </td>";
        echo "<td width='70%'>
            <h4>Corresponding Action</h4>
        </td>";
        echo "</tr>";
    foreach ($routeCollection as $value) {
    if($value->methods()[0]=='GET'){
    echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" ."<a class='d-block' href='" .URL::to(' /').'/'.str_replace('{id}','1',preg_replace($pattern, '1'
                ,$value->uri())) ."' target='__blank'>" .URL::to('/').'/'.str_replace('{id}','1',preg_replace($pattern,
                '1',$value->uri())) ."</a>" . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    }
    foreach ($routeCollection as $value) {
    if($value->methods()[0]!=='GET'){
    echo "<tr>";
        echo "<td>" . $value->methods()[0] . "</td>";
        echo "<td>" ."<p class='d-block'>" .URL::to('/').'/'.str_replace('{id}','1',preg_replace($pattern,
                '1',$value->uri())) ."</p>" . "</td>";
        echo "<td>" . $value->getName() . "</td>";
        echo "<td>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    }
    echo "</table>";
});


Route::group(
[
'prefix' => LaravelLocalization::setLocale(),
'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],
function () {


Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/faq-page', 'App/Http/Controllers/FaqController@index')->name('front.faq');


Route::get('/testimonial', 'App/Http/Controllers/TestimonialController@index')->name('front.testimonial');
Route::get('/single-testimonial', 'App/Http/Controllers/TestimonialController@show')->name('front.show.testimonial');
Route::get('/process', 'App/Http/Controllers/ProcessController@index')->name('front.process');
Route::get('/single-process', 'App/Http/Controllers/ProcessController@show')->name('front.show.process');
Route::get('/single-faq', 'App/Http/Controllers/FaqController@show')->name('front.show.faq');


}
);