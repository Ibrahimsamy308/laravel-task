<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\home\ProductResource as HomeProductResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubexpenseResource;
use App\Models\Expense;
use App\Models\Subexpense;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ExpenseController extends Controller
{
    private $expense;
    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function index()
    {
        try {
            $query = $this->expense->newQuery();
    
            if (auth()->user()->type !== 'admin') {
                $query->where('createdBy_id', auth()->id());
            }
            $data['expenses'] = ExpenseResource::collection($this->expense->latest()->get());
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $query = $this->expense->newQuery();

            if (auth()->user()->type !== 'admin') {
                $query->where('createdBy_id', auth()->id());
            }
    
            $expense = $query->findOrFail($id);
            $data['expense'] = new ExpenseResource($this->expense->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function store(ExpenseRequest $request)
    {
        try {
            $data = $request->except(['image', 'profile_avatar_remove', 'video', 'profile_video_remove']);
            $expense = $this->expense->create($data);

            if ($request->hasFile('image')) {
                $expense->uploadFile();
            }

            return response()->json([
                'status' => true,
                'message' => 'Expense created successfully',
                'data' =>new ExpenseResource( $expense)
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * PUT /api/expenses/{id}
     */
    public function update(Request $request, $id)
    {
        try {
            $expense=Expense::find($id);
            $data = $request->except(['image', 'profile_avatar_remove', 'video']);
            $expense->update($data);

            if ($request->hasFile('image')) {
                $expense->updateFile();
            }

            return response()->json([
                'status' => true,
                'message' => 'Expense updated successfully',
                'data' => $expense,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * DELETE /api/expenses/{id}
     */
    public function destroy(Expense $expense)
    {
        try {
            $expense->deleteFile();
            $expense->delete();

            return response()->json([
                'status' => true,
                'message' => 'Expense deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function summary()
    {
        try {
            $summary = Expense::selectRaw('MONTH(created_at) as month, category_id, SUM(amount) as total')
                ->groupBy('month', 'category_id')
                ->with('category.translations')
                ->get()
                ->map(function ($item) {
                    return [
                        'month' => $item->month,
                        'category_id' => $item->category_id,
                        'total' => $item->total,
                        'category_name' => $item->category
                            ? optional($item->category->translate(app()->getLocale()))->title
                            : null,
                    ];
                });
    
            return response()->json([
                'status' => true,
                'message' => 'Summary report retrieved successfully',
                'data' => $summary,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}