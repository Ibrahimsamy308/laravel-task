<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CourseRequest;
use App\Models\Lesson;
use Exception;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $course;
    function __construct(Course $course)
    {
        $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:course-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:course-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:course-delete', ['only' => ['destroy']]);
        $this->course = $course;
    }

    public function index()
    {
        try {
            $courses = $this->course->latest()->get();
            return view('admin.crud.courses.index', compact('courses'))
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
        return view('admin.crud.courses.create',compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        try {
            $data=$request->except('image','profile_avatar_remove','video','profile_video_remove');
            $course = $this->course->create($data);
            $course->uploadVideo();
            return redirect()->route('courses.index')
                ->with('success', trans('general.created_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.crud.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //    dd($course->title);
        return view('admin.crud.courses.edit', compact('course'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video','profile_video_remove');
            $course->update($data);
            $course->updateVideo();
            return redirect()->route('courses.index', compact('course'))
                ->with('success', trans('general.update_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        try {
            $course->delete();
            $course->deleteVideo();
            return redirect()->route('courses.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}