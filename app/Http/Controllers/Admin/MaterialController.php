<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MaterialRequest;
use Illuminate\Support\Facades\File;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\File as ModelsFile;
use App\Models\Lesson;
use Exception;

class MaterialController extends Controller
{
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    private $material;
    function __construct(Material $material)
    {
        $this->middleware('permission:material-list|material-create|material-edit|material-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:material-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:material-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:material-delete', ['only' => ['destroy']]);
        $this->material = $material;
    }

    public function index()
    {
        try {
            $materials = $this->material->latest()->get();
            return view('admin.crud.materials.index', compact('materials'))
                ->with('i', (request()->input('material', 1) - 1) * 5);
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
        return view('admin.crud.materials.create',compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
        try {
            
            $data = $request->except('image','profile_avatar_remove','video','profile_video_remove','materials');
            $material = $this->material->create($data);
            // $material->uploadFile();
            $material->uploadMaterials();
            
            return redirect()->route('materials.index')
                ->with('success', trans('general.created_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        return view('admin.crud.materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        // dd($material);
        $lessons=Lesson::latest()->get();
        return view('admin.crud.materials.edit', compact('material','lessons'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video','materials');
            $material->update($data);
            // $material->updateFile();
            $material->updateMaterials();
            return redirect()->route('materials.index', compact('material'))
                ->with('success', trans('general.update_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        try {
            $material->delete();
            // $material->deleteFile();
            $material->deleteVideo();
            return redirect()->route('materials.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}