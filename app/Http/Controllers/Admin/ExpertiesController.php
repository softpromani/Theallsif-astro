<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experties;
use DataTables;

class ExpertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $experties = Experties::latest()->get();
            return Datatables::of($experties)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="'. route("admin.experties.edit", $row->id) . '" class="btn btn-link p-0"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>

                         <form action="' . route("admin.experties.destroy", $row->id) . '" method="post" style="display:inline">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.experties.experties_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'experties'=>'required',
        ]);
        $res=Experties::create([
            'experties'=>$request->experties,
        ]);
        if($res)
        {
            return redirect()->back()->with('success','Experties add Successfully!');
        }
        return redirect()->back()->with('error','Experties not add!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $experties=Experties::find($id);
        return view('admin.experties.experties_index',compact('experties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'experties'=>'required',
        ]);
        $res=Experties::find($id)->update([
            'experties'=>$request->experties,
        ]);
        if($res)
        {
            return redirect()->route('admin.experties.index')->with('success','Experties updated!');
        }
        return redirect()->back()->with('error','Experties not updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experties=Experties::find($id)->delete();
        return redirect()->route('admin.experties.index')->with('error','Experties Deleted!');
    }
}
