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

        $visitor = Visitor::firstOrNew(['id' => $validated['id']]);

        if($visitor->exists){
            $visitor->id= $validated['id'];
            $visitor->name= $validated['name'];
            $visitor->telp= $validated['telp'];
            $visitor->isDeleted = 0;
            $visitor->save();
        }else{
            Visitor::create([
                'id' => $validated['id'],
                'name' => $validated['name'],
                'telp' => $validated['telp'],
                'isDeleted' => 0,
            ]);
        }

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
    public function edit($id)
    {
        return view('pages.visitor.formVisitorEdit',[
            'visitor' => Visitor::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        $validated = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'telp' => 'required',
        ]);

        $visitor = Visitor::firstOrNew(['id' => $validated['id']]);

        $visitor->id= $validated['id'];
        $visitor->name= $validated['name'];
        $visitor->telp= $validated['telp'];
        $visitor->save();

        return redirect('/visitors');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted['isDeleted'] = 1;
        Visitor::where('id',$id)->update($deleted);

        return redirect('/visitors');
    }
}
