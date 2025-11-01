<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\Complain;
use App\Models\Faq;
use App\Models\Message;
use App\Models\Counter;
use App\Models\Newsletter;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\Project;
use App\Models\Page;
use App\Models\Team;
use App\Models\Task;
use App\Models\Partner;
use App\Models\Testimonial;
use App\Models\Process;
use App\Models\Service;
use App\Models\Fee;
use App\Models\Setting;
use App\Models\User;
use App\Models\Product;
use App\Models\Vaccancy;
use App\Models\Video;
use Illuminate\Support\Facades\File;
use Jackiedo\Cart\Facades\Cart;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;

const Message_Mail = "app@gmail.com";

const Newsletter_Mail = "app@gmail.com";
function settings()
{
    return Setting::first();
}

function upload_image($file)
{
    $path = $file->store('images');
    $file->move('images', $path);
    return $path;
}


function delete_file($file)
{
    if (file_exists($file))
        File::delete($file);
}

function successResponse($data = [], $message = "success", $status = 200)
{
    return response()->json(
        [
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ],
        $status
    );
}

function failedResponse($data = [], $message = "error", $status = 400)
{
    return response()->json(
        [
            "status" => $status,
            "message" => $message,
            "data" => $data,
        ],
        $status
    );
}

function itemsCount($model)
{
   
    $items = [
        "images" => count(Image::get()),
        "users" => count(User::get()),

        "admins" => count(Admin::get()),
        "roles" => count(Role::get()),
        "categories" => count(Category::get()),
    ];


    return $items[$model];
}



    if (!function_exists('validationFailedResponse')) {
        function validationFailedResponse($errors)
        {
            return new JsonResponse([
                'status' => 420,
                'message' => 'error',
                'errors' => $errors
            ], 420);
        }
    }