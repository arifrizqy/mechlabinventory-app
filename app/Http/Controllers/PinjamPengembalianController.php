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
            'pinjam' => PostPinjam::Where('IsDeleted', 0)->get(),
            'visitor' => Visitor::Where('IsDeleted', 0)->get(),
            'pinjamForm' => Item::where('isDeleted', 0)->whereNotIn('stock', [0])->latest()->get()
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

        $totalBarangDipinjam = count($request->input('listBrgPinjam'));

        $validated['id'] = $request->input('idPinjam');
        $validated['nim_or_nip'] = $request->input('nim');
        $validated['status'] = 0;
        $validated['isDeleted'] = 0;
        PostPinjam::create($validated);

        $result = PostPinjam::where('id', $validated['id'])->first();

        for ($i = 0; $i < $totalBarangDipinjam; $i++) {
            $validated['loan_id'] = $result->id;
            $validated['item_id'] = $request->input('listBrgPinjam')[$i]["item"];
            $validated['qty'] = $request->input('listBrgPinjam')[$i]["qty"];

            DetailLoan::create($validated);
        }

        $validated = [];

        for ($i = 0; $i < $totalBarangDipinjam; $i++) {
            $item = Item::where('code_item', $request->input('listBrgPinjam')[$i]["item"])->first();

            $stok_tersedia = $item->stock;
            $stok_dipinjam = $item->borrowed;

            $validated['code_item'] = $item->id;
            $validated['borrowed'] = $stok_dipinjam + $request->input('listBrgPinjam')[$i]["qty"];
            $validated['stock'] = $stok_tersedia - $validated['borrowed'];

            Item::where('id', $validated['code_item'])->update($validated);
        }

        return redirect('/pinjam-pengembalian');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostPinjam $postPinjam, $id)
    {
        $dataPinjam = PostPinjam::where('id', $id)->first();
        $dataVisitor = Visitor::where('id', $dataPinjam->nim_or_nip)->first();
        $dataDetail = DetailLoan::where('loan_id', $dataPinjam->id)->get();

        for ($i = 0; $i < count($dataDetail); $i++) {
            $dataBarangDipinjam[$i] = Item::where('code_item', $dataDetail[$i]->item_id)->first();
        }

        return array(
            'dataVisitor' => $dataVisitor,
            'dataPinjam' => $dataPinjam,
            'dataDetail' => $dataDetail,
            'dataBrg' => $dataBarangDipinjam,
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

        foreach ($detail as $dt) {
            $idDetail = $dt->id;
            $jmlPinjam = $dt->qty;

            $item = Item::where('code_item', $dt->item_id)->first();
            $jmlStock = $item->stock;
            $total = $jmlStock + $jmlPinjam;
            $item->update(['borrowed' => 0, 'stock' => $total]);

            DetailLoan::where('id', $idDetail)->update(['qty' => 0]);
        }

        return redirect('/pinjam-pengembalian');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostPinjam $postPinjam, $id)
    {
        $post = PostPinjam::where('id', $id)->first();
        // DetailLoan::where('loan_id', $post->id)->deleted();
        $detail = DetailLoan::where('loan_id', $post->id)->get();

        foreach($detail as $dt){
            $idDetail = $dt->id;
            $jmlPinjam = $dt->qty;

            $item = Item::where('code_item', $dt->item_id)->first();
            $jmlStock = $item->stock;
            $total = $jmlStock + $jmlPinjam;
            $item->update(['borrowed' => 0, 'stock' => $total]);

            DetailLoan::where('id', $idDetail)->delete();
        }

        $post->delete();
        return redirect('/pinjam-pengembalian');
    }
}
