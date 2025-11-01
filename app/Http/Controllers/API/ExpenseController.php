<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
            $data['expenses'] = ExpenseResource::collection($this->expense->latest()->get());
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $data['expense'] = new ExpenseResource($this->expense->findorfail($id));
            return successResponse($data);
        } catch (Exception $e) {

            return failedResponse($e->getMessage());
        }
    }
}