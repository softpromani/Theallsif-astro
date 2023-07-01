<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\language;
use DataTables;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if (request()->ajax()) {
            $language = Language::latest()->get();
            return Datatables::of($language)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    return '<a href="'. route("admin.language.edit", $row->id) . '" class="btn btn-link p-0"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>

                         <form action="' . route("admin.language.destroy", $row->id) . '" method="post" style="display:inline">
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
        return view('admin.language.language_index');
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
            'language'=>'required',
        ]);
        $res=Language::create([
            'language'=>$request->language,
        ]);
        if($res)
        {
            return redirect()->back()->with('success','Language add Successfully!');
        }
        return redirect()->back()->with('error','Language not add!');
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
        $language=Language::find($id);
        return view('admin.language.language_index',compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'language'=>'required',
        ]);
        $res=Language::find($id)->update([
            'language'=>$request->language,
        ]);
        if($res)
        {
            return redirect()->route('admin.language.index')->with('success','Language Updated!');
        }
        return redirect()->back()->with('error','Language not Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language=Language::find($id)->delete();
        return redirect()->route('admin.language.index')->with('error','Language Deleted!');
    }
}
