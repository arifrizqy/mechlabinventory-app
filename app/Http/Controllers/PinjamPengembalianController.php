<?php

namespace App\Http\Controllers;

use App\Models\PostPinjam;
use App\Models\Item;
use App\Models\Visitor;
use Illuminate\Http\Request;

class PinjamPengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.pinjam-pengembalian.pinjam-pengembalian-view',[
            'pinjam' => PostPinjam::Where('IsDeleted', 0)->latest()->get()

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pinjam-pengembalian.formPinjam',[
            'visitor' => Visitor::Where('IsDeleted', 0)->get(),
            'pinjam' => Item::where('isDeleted', 0)->where('isBorrowed', 0)->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'nim' => 'required',
        // ]);

        $validated['nim'] = $request->input('nim');
        $validated['item_id'] = $request->input('barang');
        $validated['status'] = 0;
        $validated['isDeleted'] = 0;

        PostPinjam::create($validated);
        Item::where('code_item', $validated['item_id'])->update(['isBorrowed' => 1]);

        return redirect('/pinjam-pengembalian');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostPinjam $postPinjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostPinjam $postPinjam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostPinjam $postPinjam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPinjam $postPinjam,$id)
    {
        $post= PostPinjam::where('id',$id);
        $post->delete();
        return redirect('/pinjam-pengembalian');
    }


}
