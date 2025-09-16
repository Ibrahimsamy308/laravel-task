<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\VideoRequest;
use App\Models\Lesson;
use Exception;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $video;
    function __construct(Video $video)
    {
        $this->middleware('permission:video-list|video-create|video-edit|video-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:video-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:video-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:video-delete', ['only' => ['destroy']]);
        $this->video = $video;
    }

    public function index()
    {
        try {
            $videos = $this->video->latest()->get();
            return view('admin.crud.videos.index', compact('videos'))
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
        return view('admin.crud.videos.create',compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        try {
            $data=$request->except('image','profile_avatar_remove','video','profile_video_remove');
            $video = $this->video->create($data);
            $video->uploadVideo();
            return redirect()->route('videos.index')
                ->with('success', trans('general.created_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin.crud.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //    dd($video->title);
        return view('admin.crud.videos.edit', compact('video'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        try {
            $data = $request->except('image','profile_avatar_remove');
            $video->update($data);
            return redirect()->route('videos.index', compact('video'))
                ->with('success', trans('general.update_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        try {
            $video->delete();
            return redirect()->route('videos.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}