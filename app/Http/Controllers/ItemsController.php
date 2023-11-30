<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.item.item-view', [
            'title' => 'Items',
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

        $this->validate($request,[
            'id' => 'required',
            'image' => 'required|file|mimes:jpg,jpeg,png|max:5120',
            'description' => 'required',
            'qty' => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/itemPost', $image->hashName());


        $item = Item::firstOrNew(['id' => $request->id]);

        // Cek apakah item dengan ID yang diberikan sudah ada dalam database
        if ($item->exists) {
            $item->description = $request->description;
            $item->code_item = $request->id;
            $item->image = $image->hashName();
            $item->isDeleted = 0;
            $item->qty= $request->qty;
            $item->borrowed = 0;
            $item->save();
        } else {
            // Jika item tidak ditemukan, buat item baru
            Item::create([
                'id' => $request->id,
                'description' => $request->description,
                'code_item' => $request->id,
                'image' => $image->hashName(),
                'isDeleted' => 0,
                'qty' => $request->qty,
                'borrowed' => 0,
            ]);
        }

        return redirect('/items');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataItem = Item::where('code_item', $id)->first();

        return array(
            'itemDetail' => $dataItem
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pages.item.formItemEdit', [
            'item' => Item::where('code_item', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'image' => 'file|mimes:jpg,jpeg,png|max:5120',
            'id' => 'required',
            'description' => 'required',
            'qty' => 'required',
        ]);

        $item = Item::firstOrNew(['id' => $validated['id']]);
        if ($request->hasFile('image')) {
            //upload image
            $image = $request->file('image');
            $image->storeAs('public/itemPost', $image->hashName());

            Storage::delete('public/itemPost/'.$item->image);

            $item->description = $validated['description'];
            $item->code_item = $request->input('id');
            $item->image =  $image->hashName();
            $item->qty= $validated['qty'];
            $item->save();

        } else {
            $item->description = $validated['description'];
            $item->code_item = $request->input('id');
            $item->qty= $validated['qty'];
            $item->save();
        }




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
