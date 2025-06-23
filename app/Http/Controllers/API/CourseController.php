<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    private $course;
    public function __construct(Course $course)
    {
        $this->course = $course;
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
            $courses = $this->course->latest()->paginate($perPage);
            $data = CourseResource::collection($courses);
            $pagination = [
                'current_page' => $courses->currentPage(),
                'per_page' => $courses->perPage(),
                'last_page' => $data->lastPage(),
                'total_items' => $courses->total(),
            ];
            return response()->json(['pagination' => $pagination, 'data' => $data], 200);


        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['course'] = new CourseResource($this->course->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }
    
}