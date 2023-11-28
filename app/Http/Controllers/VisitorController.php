<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.visitor.visitor-view', [
            'visitor' => Visitor::where('isDeleted', 0)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.visitor.formVisitor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // DD($request);
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'telp' => 'required',
        ]);

        $validated['isDeleted'] = 0;

        Visitor::create($validated);

        return redirect('/visitors');

    }

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        $deleted['isDeleted'] = 1;
        $id= $request->input('id');
        Visitor::where('id',$id)->update($deleted);
        return redirect('/visitors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {

    }
}
