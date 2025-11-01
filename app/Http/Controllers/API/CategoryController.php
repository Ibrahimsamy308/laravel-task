<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\home\ProductResource as HomeProductResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubcategoryResource;
use App\Models\Category;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        try {
            $data['categories'] = CategoryResource::collection($this->category->latest()->get());
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['category'] = new CategoryResource($this->category->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function store(CategoryRequest $request)
    {
        try { 
            $data = $request->except(['image', 'profile_avatar_remove', 'video', 'profile_video_remove']);
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            $category = $this->category->create($data);
            if ($request->hasFile('image')){
                $category->uploadFile();
            }

            return response()->json([
                'status' => true,
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * PUT /api/categories/{id}
     */
    public function update(CategoryRequest $request, $id)
    {
        try {

           $category=Category::find($id);
            $data = $request->except(['image','profile_avatar_remove']);
            $data['is_active'] = $request->has('is_active') ? 1 : 0;

            $category->update($data);
            if ($request->hasFile('image')){
                
                $category->updateFile();
            }

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
                'data' => new CategoryResource($category)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * DELETE /api/categories/{id}
     */
    public function destroy( $id)
    {
        try {

            $category=Category::find($id);

            if ($category->expenses()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cannot delete category with linked expenses.'
                ], 403);
            }

            $category->deleteFile();
            $category->delete();

            return response()->json([
                'status' => true,
                'message' => 'Category deleted successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}