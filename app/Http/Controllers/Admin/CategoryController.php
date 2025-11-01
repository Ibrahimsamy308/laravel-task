<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\File as ModelsFile;
use Exception;

class CategoryController extends Controller
{
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    private $category;
    function __construct(Category $category)
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
        $this->category = $category;
    }

    public function index()
    {
        try {
            $categories = $this->category->latest()->get();
            return view('admin.crud.categories.index', compact('categories'))
                ->with('i', (request()->input('category', 1) - 1) * 5);
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
        return view('admin.crud.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video','profile_video_remove');
            $data['is_active'] = $request->has('is_active') ? 1 : 0;
            $category = $this->category->create($data);
            $category->uploadFile();
            
            return redirect()->route('categories.index')
                ->with('success', trans('general.created_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.crud.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd($category);
        return view('admin.crud.categories.edit', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video');
            $data['is_active'] = $request->has('is_active') ? 1 : 0;
            $category->update($data);
            $category->updateFile();
            return redirect()->route('categories.index', compact('category'))
                ->with('success', trans('general.update_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            $category->deleteFile();
            return redirect()->route('categories.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}