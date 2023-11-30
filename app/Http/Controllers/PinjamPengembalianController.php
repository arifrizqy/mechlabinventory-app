<?php

namespace App\Http\Controllers;

use App\Models\PostPinjam;
use App\Models\Item;
use App\Models\Visitor;
use App\Models\DetailLoan;
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
            'pinjamForm' => Item::where('isDeleted', 0)->where('stock', [0])->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('pages.pinjam-pengembalian.formPinjam', [
        //     'visitor' => Visitor::Where('IsDeleted', 0)->get(),
        //     'pinjam' => Item::where('isDeleted', 0)->whereNotIn('stock', [0])->latest()->get()
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required',
        ]);

        $validated['nim'] = $request->input('nim');
        $validated['item_id'] = $request->input('barang');
        $validated['status'] = 0;
        $validated['isDeleted'] = 0;
        // for ($i = 0; $i < $request->input('listBrgPinjam'); $i++) {
        //     $validated['nim_or_nip'] = $request->input('nim');
        //     $validated['item_id'] = $request->input('listBrgPinjam')[$i]["item"];
        //     // $validated['stock'] = $request->input('listBrgPinjam')[$i]["stock"];
        //     $validated['status'] = 0;
        //     $validated['isDeleted'] = 0;

        PostPinjam::create($validated);



        $item = Item::where('code_item', $validated['item_id']);
        $total = $item->stock;
        $item->update(['borrowed' => $pinjam, 'stock' => $total - $pinjam]);
        // }
        //     PostPinjam::create($validated);
        //     Item::where('code_item', $validated['item_id'])->update(['isBorrowed' => 1]);

        return $request->input('listBrgPinjam');

        // return redirect('/pinjam-pengembalian');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostPinjam $postPinjam, $id)
    {
        $dataPinjam = PostPinjam::where('id', $id)->first();
        $dataVisitor = Visitor::where('id', $dataPinjam->nim_or_nip)->first();
        $dataDetail = DetailLoan::where('loan_id', $dataPinjam->id)->latest()->get();


        return array(
            'dataVisitor' => $dataVisitor,
            'dataItemVisitor' => $dataItem,
            'dataDetail' => $dataDetail,
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
        $detail = DetailLoan::where('loan_id', $post->id)->latest()->get();

        foreach($detail as $dt){
            $idDetail = $dt->id;
            $jmlPinjam = $dt->qty;

            $item = Item::where('code_item', $dt->item_id)->first();
            $jmlStock = $item->stock;
            $total = $jmlStock + $jmlPinjam;
            $item->update(['borrowed' => 0, 'stock' => $total]);

            DetailLoan::where('id', $idDetail)->update(['qty' => 0]);
        }



        // $item = Item::where('code_item', $post->item_id);
        // $sum = $item->borrowed; //ambil jumlah dipinjam
        // $count = $item->stock; //ambil jumlah quantity
        // $item->update(['borrowed' => 0, 'stock' => $sum + $count]);
        // return redirect('/pinjam-pengembalian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPinjam $postPinjam, $id)
    {
        $post = PostPinjam::where('id', $id)->first();

        $item = Item::where('code_item', $post->item_id);
        $sum = $item->borrowed;
        $count = $item->stock;
        $item->update(['borrowed' => 0, 'stock' => $sum + $count]);

        $post->delete();
        return redirect('/pinjam-pengembalian');
    }
}
