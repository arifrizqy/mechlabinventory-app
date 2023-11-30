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
        return view('pages.pinjam-pengembalian.pinjam-pengembalian-view', [
            'title' => 'Pinjam - Pengembalian',
            'pinjam' => PostPinjam::Where('IsDeleted', 0)->latest()->get(),
            'visitor' => Visitor::Where('IsDeleted', 0)->get(),
            'pinjamForm' => Item::where('isDeleted', 0)->where('isBorrowed', 0)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pinjam-pengembalian.formPinjam', [
            'visitor' => Visitor::Where('IsDeleted', 0)->get(),
            'pinjam' => Item::where('isDeleted', 0)->whereNotIn('qty', [0])->latest()->get()
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

        // for ($i=0; $i < ; $i++) {
        $validated['nim'] = $request->input('nim');
        $validated['item_id'] = $request->input('barang' . $i);
        $validated['status'] = 0;
        $validated['isDeleted'] = 0;
        // for ($i = 0; $i < $request->input('listBrgPinjam'); $i++) {
        //     $validated['nim_or_nip'] = $request->input('nim');
        //     $validated['item_id'] = $request->input('listBrgPinjam')[$i]["item"];
        //     // $validated['qty'] = $request->input('listBrgPinjam')[$i]["qty"];
        //     $validated['status'] = 0;
        //     $validated['isDeleted'] = 0;

        PostPinjam::create($validated);

        $pinjam = 9; //ambil data validasi dari total yang dipinjam

        $item = Item::where('code_item', $validated['item_id']);
        $total = $item->qty;
        $item->update(['borrowed' => $pinjam, 'qty' => $total - $pinjam]);
        // }
        //     PostPinjam::create($validated);
        //     Item::where('code_item', $validated['item_id'])->update(['isBorrowed' => 1]);
        // }

        return $request->input('listBrgPinjam');

        // return redirect('/pinjam-pengembalian');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostPinjam $postPinjam, $id)
    {
        $dataPinjam = PostPinjam::where('id', $id)->first();
        $dataVisitor = Visitor::where('id', $dataPinjam->nim)->first();
        $dataItem = Item::where('id', $dataPinjam->item_id)->first();


        return array(
            'dataVisitor' => $dataVisitor,
            'dataItemVisitor' => $dataItem,
            'dataPinjam' => $dataPinjam,
        );
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
    public function update(Request $request, PostPinjam $postPinjam, $id)
    {
        $status['status'] = 1;
        $post = PostPinjam::where('id', $id)->first();
        $post->update($status);

        // Item::where('code_item', $post->item_id)->update(['borrowed' => 0]);



        $item = Item::where('code_item', $post->item_id);
        $sum = $item->borrowed; //ambil jumlah dipinjam
        $count = $item->qty; //ambil jumlah quantity
        $item->update(['borrowed' => 0, 'qty' => $sum + $count]);
        return redirect('/pinjam-pengembalian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPinjam $postPinjam, $id)
    {
        $post = PostPinjam::where('id', $id)->first();

        $item = Item::where('code_item', $post->item_id);
        $sum = $item->borrowed;
        $count = $item->qty;
        $item->update(['borrowed' => 0, 'qty' => $sum + $count]);

        $post->delete();
        return redirect('/pinjam-pengembalian');
    }
}
