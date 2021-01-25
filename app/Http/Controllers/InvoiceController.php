<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{
    public function view()
    {
        return view('admin.contents.finance.invoices', [
            'projects' => Project::all(),
        ]);
    }

    public function generate()
    {
        $i = Invoice::count() + 1;
        return "#{$i}";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(JsonResource::collection(Invoice::all()))->toJson();
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
            'project_id' => ['required', Rule::exists('projects', 'id')],
            'address' => ['required', 'string', 'max:255'],
            'invoice_number' => ['required', 'string', 'max:255'],
            'date_of_issue' => ['required', 'date'],
            'due_date' => ['required', 'date'],
            'status' => ['required', 'string', Rule::in(['Unpaid', 'Paid', 'Partially Paid'])],
            'items' => ['required', 'array'],
            'items.*.name' => ['required', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string', 'max:255'],
            'items.*.cost' => ['required', 'numeric'],
            'items.*.quantity' => ['required', 'numeric'],
        ]);

        return Invoice::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return $invoice;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'project_id' => ['required', Rule::exists('projects', 'id')],
            'address' => ['nullable', 'string', 'max:255'],
            'invoice_number' => ['nullable', 'string', 'max:255'],
            'date_of_issue' => ['nullable', 'date'],
            'due_date' => ['nullable', 'date'],
            'status' => ['nullable', 'string', Rule::in(['Unpaid', 'Paid', 'Partially Paid'])],
            'items' => ['nullable', 'array'],
            'items.*.name' => ['nullable', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string', 'max:255'],
            'items.*.cost' => ['nullable', 'numeric'],
            'items.*.quantity' => ['nullable', 'numeric'],
        ]);

        $invoice->update($data);

        return $invoice;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response('', 204);
    }
}
