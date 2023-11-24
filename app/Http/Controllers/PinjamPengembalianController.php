<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PinjamPengembalianController extends Controller
{
    public function index() {
        return view('pages.pinjam-pengembalian.pinjam-pengembalian-view');
    }
}
