<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InstructorResource;
use App\Http\Resources\home\ProductResource as HomeProductResource;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function index()
    {
        try {
            $data['instructors'] = InstructorResource::collection($this->admin->latest()->get());
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['instructor'] = new InstructorResource($this->admin->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }
    
}