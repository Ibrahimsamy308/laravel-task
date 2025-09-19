<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ExamRequest;
use Illuminate\Support\Facades\File;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\File as ModelsFile;
use Exception;

class ExamController extends Controller
{
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    private $exam;
    function __construct(Exam $exam)
    {
        $this->middleware('permission:exam-list|exam-create|exam-edit|exam-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:exam-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:exam-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:exam-delete', ['only' => ['destroy']]);
        $this->exam = $exam;
    }

    public function index()
    {
        try {
            $exams = $this->exam->latest()->get();
            return view('admin.crud.exams.index', compact('exams'))
                ->with('i', (request()->input('exam', 1) - 1) * 5);
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crud.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video','profile_video_remove');
            $exam = $this->exam->create($data);
            // $exam->uploadFile();
            $exam->uploadVideo();
            
            return redirect()->route('exams.index')
                ->with('success', trans('general.created_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('admin.crud.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        // dd($exam);
        return view('admin.crud.exams.edit', compact('exam'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video');
            $exam->update($data);
            // $exam->updateFile();
            $exam->updateVideo();
            return redirect()->route('exams.index', compact('exam'))
                ->with('success', trans('general.update_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        try {
            $exam->delete();
            // $exam->deleteFile();
            $exam->deleteVideo();
            return redirect()->route('exams.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}