<?php

namespace App\Http\Controllers;

use App\Models\PostPinjam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.pinjam-pengembalian.pinjam-pengembalian-view', [
            'pinjam' => PostPinjam::Where('IsDeleted', 0)->latest()->get()
        ]);
    }
}
