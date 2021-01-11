<?php

namespace App\Http\Controllers;

use App\Estimate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Yajra\DataTables\DataTables;

class EstimateController extends Controller
{
    public function view()
    {
        return view('admin.contents.finance.estimates');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DataTables::of(JsonResource::collection(Estimate::all()))->toJson();
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
            'valid_until' => ['required', 'date'],
            'estimate_number' => ['required', 'string', 'max:255'],
            'items' => ['required', 'array'],
            'items.*.name' => ['required', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string', 'max:255'],
            'items.*.cost' => ['required', 'numeric'],
            'items.*.quantity' => ['required', 'numeric'],
        ]);

        return Estimate::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {
        return $estimate;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estimate $estimate)
    {
        $data = $request->validate([
            'valid_until' => ['nullable', 'date'],
            'estimate_number' => ['nullable', 'string', 'max:255'],
            'items' => ['nullable', 'array'],
            'items.*.name' => ['nullable', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string', 'max:255'],
            'items.*.cost' => ['nullable', 'numeric'],
            'items.*.quantity' => ['nullable', 'numeric'],
        ]);

        $estimate->update($data);

        return $estimate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        $estimate->delete();

        return response('', 204);
    }
}
