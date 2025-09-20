<?php

namespace App\Http\Controllers\Admin;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LessonRequest;
use Exception;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $Lesson;
    function __construct(lesson $lesson)
    {
        $this->middleware('permission:lesson-list|lesson-create|lesson-edit|lesson-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:lesson-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:lesson-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:lesson-delete', ['only' => ['destroy']]);
        $this->Lesson = $lesson;
    }

    public function index()
    {
        try {
            $lessons = $this->Lesson->latest()->get();
            return view('admin.crud.lessons.index', compact('lessons'))
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
    $courses = Course::all();
    return view('admin.crud.lessons.create', compact('courses'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

public function store(LessonRequest $request)
{
    $data = $request->validated();

    $lesson = new Lesson();
    $lesson->course_id   = $data['course_id'] ?? null;
    $lesson->duration    = $data['duration'];
    $lesson->lessonOrder = $data['lessonOrder'] ?? 0;
    $lesson->is_free = $request->boolean('is_free');

    foreach (config('translatable.locales') as $locale) {
        $lesson->translateOrNew($locale)->title = $data[$locale]['title'];
        $lesson->translateOrNew($locale)->description = $data[$locale]['description'];
    }

    $lesson->save();

    return redirect()->route('lessons.index')->with('success', __('general.created_successfully'));
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function show(lesson $lesson)
    {
            $courses = Course::all();
        return view('admin.crud.lessons.show', compact('lesson', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lesson  $lesson
     * @return \Illuminate\Http\Response
     */

    
  public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('admin.crud.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        // كل الحقول العادية
        $data = $request->only([
            'course_id',
            'video_url',
            'duration',
            'lessonOrder',
            'is_free',
        ]);

        // تحديث الترجمات (title, description)
        foreach (config('translatable.locales') as $locale) {
            $data[$locale] = [
                'title' => $request->input($locale . '.title'),
                'description' => $request->input($locale . '.description'),
            ];
        }

        // اعمل update للموديل
        $lesson->update($data);

        return redirect()
            ->route('lessons.index')
            ->with('success', __('general.updated_successfully'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lesson  $lesson
     * @return \Illuminate\Http\Response
     */
    public function destroy(lesson $lesson)
    {
        try {
            $lesson->delete();
            return redirect()->route('lessons.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}