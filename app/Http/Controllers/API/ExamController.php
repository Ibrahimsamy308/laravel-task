<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AnswerRequest;
use App\Http\Requests\API\WatchRequest;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use App\Models\UserExam;
use App\Models\UserVideo;
use Exception;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    private $exam;
    public function __construct(Exam $exam)
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
        $this->exam = $exam;
    }

    public function index()
    {
        try {
            $data['exams'] = ExamResource::collection($this->exam->latest()->get());
            return successResponse($data,trans('general.sent_successfully'));
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['exam'] = new ExamResource($this->exam->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }


    public function examSubmit(AnswerRequest $request)
    {
        try {
            
            $submission = UserExam::create([
                'exam_id' => $request->exam_id,
                'user_id' => auth()->id(), 
                'score'   => $request->score,
                'answers' => $request->answers, 
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Exam submitted successfully',
                'data' => $submission,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function watchedVideos(WatchRequest $request)
    {
        try {
            
            $watched = UserVideo::create([
                'video_id' => $request->video_id,
                'user_id' => auth()->id(), 
                'watched_at'   => now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'video watched successfully',
                'data' => $watched,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}