<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ExpenseRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\File as ModelsFile;
use App\Models\Vendor;
use Exception;

class ExpenseController extends Controller
{
    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Responses
     */
    private $expense;
    function __construct(Expense $expense)
    {
        $this->middleware('permission:expense-list|expense-create|expense-edit|expense-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:expense-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
        $this->expense = $expense;
    }

    public function index()
    {
        try {
            $expenses = $this->expense->latest()->get();
            return view('admin.crud.expenses.index', compact('expenses'))
                ->with('i', (request()->input('expense', 1) - 1) * 5);
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
        $categories=Category::latest()->get();
        $vendors=Vendor::latest()->get();
        return view('admin.crud.expenses.create',compact('categories','vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video','profile_video_remove');
            $expense = $this->expense->create($data);
            $expense->uploadFile();
            
            return redirect()->route('expenses.index')
                ->with('success', trans('general.created_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return view('admin.crud.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        // dd($expense);
        $categories=Category::latest()->get();
        $vendors=Vendor::latest()->get();
        return view('admin.crud.expenses.edit', compact('expense','categories','vendors'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\portfolio  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        try {
            $data = $request->except('image','profile_avatar_remove','video');
            $expense->update($data);
            $expense->updateFile();
            return redirect()->route('expenses.index', compact('expense'))
                ->with('success', trans('general.update_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        try {
            $expense->delete();
            $expense->deleteFile();
            return redirect()->route('expenses.index')
                ->with('success', trans('general.deleted_successfully'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with(['error' => __('general.something_wrong')]);
        }
    }
}