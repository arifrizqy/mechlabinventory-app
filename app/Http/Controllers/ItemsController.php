<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.item.item-view', [
            'items' => Item::where('isDeleted', 0)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.item.formItem');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'description' => 'required',

        ]);
        $validated['code_item'] = $request->input('id');
        $validated['isDeleted'] = 0;
        $validated['isBorrowed'] = 0;


        Item::create([
            'id' => $validated['id'],
            'description' => $validated['description'],
            'code_item' => $validated['code_item'],
            'isDeleted' => $validated['isDeleted'],
            'isBorrowed' => $validated['isBorrowed'],

        ]);
        return redirect('/items');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item, $id)
    {
        $deleted['isDeleted'] = 1;
        Item::where('code_item', $id)->update($deleted);
        return redirect('/items');
    }
}
