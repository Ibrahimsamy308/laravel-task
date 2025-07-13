<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    private $lesson;
    public function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
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
            $lessons = $this->lesson->latest()->paginate($perPage);
            $data = LessonResource::collection($lessons);
            $pagination = [
                'current_page' => $lessons->currentPage(),
                'per_page' => $lessons->perPage(),
                'last_page' => $data->lastPage(),
                'total_items' => $lessons->total(),
            ];
            return response()->json(['pagination' => $pagination, 'data' => $data], 200);


        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['lesson'] = new LessonResource($this->lesson->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }
    
}