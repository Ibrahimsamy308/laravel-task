<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserExam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserExamRequest;
use App\Models\Lesson;
use Exception;

class UserExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $userExam;
    function __construct(UserExam $userExam)
    {
        $this->middleware('permission:userExam-list|userExam-create|userExam-edit|userExam-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:userExam-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:userExam-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:userExam-delete', ['only' => ['destroy']]);
        $this->userExam = $userExam;
    }

    public function index()
    {
        try {
            $userExams = $this->userExam->latest()->get();
            return view('admin.crud.userExams.index', compact('userExams'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $lessons=Lesson::latest()->get();
        return view('admin.crud.userExams.create',compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserExamRequest $request)
    {
        try {
            $data=$request->except('image','profile_avatar_remove','video','profile_video_remove');
            $userExam = $this->userExam->create($data);
            $userExam->uploadVideo();
            $userExam->uploadFile();
            return redirect()->route('userExams.index')
                ->with('success', trans('general.created_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserExam  $userExam
     * @return \Illuminate\Http\Response
     */
    public function show(UserExam $userExam)
    {
        $userExam->decoded_answers = json_decode($userExam->answers, true) ;
        return view('admin.crud.userExams.show', compact('userExam',));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserExam  $userExam
     * @return \Illuminate\Http\Response
     */
    public function edit(UserExam $userExam)
    {
        //    dd($userExam->title);
        return view('admin.crud.userExams.edit', compact('userExam'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $userExam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserExam $userExam)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video','profile_video_remove');
            $userExam->update($data);
            $userExam->updateVideo();
            $userExam->updateFile();
            return redirect()->route('userExams.index', compact('userExam'))
                ->with('success', trans('general.update_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserExam  $userExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserExam $userExam)
    {
        try {
            $userExam->delete();
            $userExam->deleteVideo();
            $userExam->deleteFile();
            return redirect()->route('userExams.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}