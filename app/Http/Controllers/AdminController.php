<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.admin-view',[
            'admin' => Admin::where('isDeleted' , 0)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'username' => 'required',
        //     'pass' => 'required',
        // ]);
        // DD($validated);
        Admin::create([
            'username' => $request->input('username'),
            'pass' => $request->input('pass'),
        ]);

        return redirect('/admin-list');
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('pages.admin.form');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('pages.admin.formEdit',[
            'admin' => Admin::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $update = $request->validate([
            'id' => 'required',
            'username' => 'required',
            'pass' => 'required',
        ]);

        $admin = Admin::where(['id' => $update['id']])->first();

        $admin->username = $update['username'];
        $admin->pass = $update['pass'];
        $admin->save();

        return redirect('/admin-list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted['isDeleted'] = 1;
        Admin::where('id',$id)->update($deleted);
        return redirect('/admin-list');
    }
}
