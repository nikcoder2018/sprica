<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function view()
    {
        return view('admin.contents.finance.expenses', [
            'users' => User::all(),
            'projects' => Project::all(),
            'categories' => ExpenseCategory::all(),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(JsonResource::collection(Expense::all()))->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_id' => ['required', Rule::exists(User::class, 'id')],
            'project_id' => ['required', Rule::exists(Project::class, 'id')],
            'purchased_from' => ['required', 'string', 'max:255'],
            'purchase_date' => ['required', 'date'],
            'category_id' => ['required', Rule::exists(ExpenseCategory::class, 'id')],
            'price' => ['required', 'numeric'],
            'currency' => ['required', 'string', 'max:255'],
            'bill' => ['required', 'file'],
        ]);

        /**
         * @var \Illuminate\Http\UploadedFile
         */
        $file = $data['bill'];

        $data['bill'] = $file->storePublicly('/public/bills') ?: '';

        return Expense::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        return $expense;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'user_id' => ['nullable', Rule::exists(User::class, 'id')],
            'project_id' => ['nullable', Rule::exists(Project::class, 'id')],
            'purchased_from' => ['nullable', 'string', 'max:255'],
            'purchase_date' => ['nullable', 'date'],
            'category_id' => ['nullable', Rule::exists(ExpenseCategory::class, 'id')],
            'price' => ['nullable', 'numeric'],
            'currency' => ['nullable', 'string', 'max:255'],
            'bill' => ['nullable', 'file'],
        ]);

        if (isset($data['bill']) && $data['bill']->isValid()) {
            Storage::delete($expense->getAttributes()['bill']);
            $data['bill'] = $data['bill']->storePublicly('/public/bills') ?: '';
        }

        $expense->update($data);

        return $expense;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response('', 204);
    }
}
