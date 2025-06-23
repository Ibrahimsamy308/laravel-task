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

    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'per_page' => 'integer|min:1|max:100',
            ]);
    
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                $errors['message'] = 'Validation Error';
                return response()->json(['errors' => $errors], 420);
            }
    
            $perPage = $request->input('per_page', 10);
            $instructors = $this->admin->where('type','instructor')->latest()->paginate($perPage);
            $data = InstructorResource::collection($instructors);
            $pagination = [
                'current_page' => $instructors->currentPage(),
                'per_page' => $instructors->perPage(),
                'last_page' => $data->lastPage(),
                'total_items' => $instructors->total(),
            ];
            return response()->json(['pagination' => $pagination, 'data' => $data], 200);

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