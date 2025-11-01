<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\Expense;
use App\Models\Setting;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;


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
        "users" => count(User::get()),

        "admins" => count(Admin::get()),
        "roles" => count(Role::get()),
        "categories" => count(Category::get()),
        "vendors" => count(Vendor::get()),
        "expenses" => count(Expense::get()),
    ];


    return $items[$model];
}


function vendors()
{
    $vendors = Vendor::latest()->take(14)->get();

    return $vendors;
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