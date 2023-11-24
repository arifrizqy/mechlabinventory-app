<?php

namespace App\Http\Controllers;

use App\Models\LabItems;
use App\Http\Requests\StoreLabItemsRequest;
use App\Http\Requests\UpdateLabItemsRequest;

class LabItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.item.item-view', [
            'items' => LabItems::where('isDeleted', 0)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabItemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LabItems $labItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LabItems $labItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabItemsRequest $request, LabItems $labItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabItems $labItems)
    {
        //
    }
}
