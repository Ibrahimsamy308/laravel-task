<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Exception;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    private $exam;
    public function __construct(Exam $exam)
    {
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
}