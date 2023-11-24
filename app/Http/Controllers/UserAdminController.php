<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index() {
        return view('pages.admin.admin-view');
    }

    public function storeData() {
        return view('pages.admin.form');
    }
}
