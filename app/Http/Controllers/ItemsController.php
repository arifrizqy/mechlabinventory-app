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

        $item = Item::firstOrNew(['id' => $validated['id']]);

        // Cek apakah item dengan ID yang diberikan sudah ada dalam database
        if ($item->exists) {
            $item->description = $validated['description'];
            $item->code_item = $request->input('id');
            $item->isDeleted = 0;
            $item->isBorrowed = 0;
            $item->save();
        } else {
            // Jika item tidak ditemukan, buat item baru
            Item::create([
                'id' => $validated['id'],
                'description' => $validated['description'],
                'code_item' => $validated['id'],
                'isDeleted' => 0,
                'isBorrowed' => 0,
            ]);
        }

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
    public function edit($id)
    {
        return view('pages.item.formItemEdit',[
            'item' =>Item::where('code_item', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'id' => 'required',
            'description' => 'required',
        ]);

        $item = Item::firstOrNew(['id' => $validated['id']]);
        $item->description = $validated['description'];
        $item->code_item = $request->input('id');
        $item->save();


        return redirect('/items');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted['isDeleted'] = 1;
        $item = Item::where('code_item', $id);
        $item->update($deleted);
        return redirect('/items');
    }
}
