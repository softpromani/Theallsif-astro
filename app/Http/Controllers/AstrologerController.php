<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Astrologer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AstrologerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Astrologer::get();
        return view('admin.astrologer.astrologer',compact('data'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required',
            'country' => 'required',
            'image' => 'required|image',
        ]);
        if($request->hasFile('image')){
            $imageName = 'Img'.time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);        
            }

        $data = Astrologer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'image' =>$imageName,
        ]);
        if ($data) {
            return redirect()->back()->with('success', 'Astrologer added successfully!');
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit=Astrologer::find($id);
        return view('admin.astrologer.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email'=>'required|unique:users|email',
            'phone'=>'required',
            'country'=>'required',
            'image'=>'required|image'
        ]);
        $image=Astrologer::find($id);
        $oldImagePath = public_path('images/' .$image->image);

        if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($image->image) {
            $oldImagePath = public_path('images/' . $image->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }
        $imageName = 'Img'.time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName); 
        }
        $data=Astrologer::find($id)->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'country'=>$request->country,
            'image'=> $imageName,
        ]);
        if($data)
        {

            return redirect()->route('astrologer.index')->with('success', 'Astrologer Update successfully!.');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $delete=Astrologer::find($id)->delete();
        if($delete)
        {
           return redirect()->back()->with('danger', 'Astrologer Add successfully!.');
        }
        return redirect()->back();
    }
}
