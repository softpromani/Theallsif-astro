<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.auth.profile');
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data=$request->validate([
            'name'=>'required',
            'email' => 'required|unique:users|email',
        ]);
        $admin=Auth::guard('admin')->user();
        if($admin)
        {
            $adm=Admin::find($admin->id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
            return redirect()->back()->with('success','Profile Updated Successfully!');
        }
        return redirect()->back()->with('error','Profile not updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function profileImage(Request $request,$id)
    {
        $admin=Auth::guard('admin')->user();
        if($request->hasFile('image')){
            $imageName = 'Img-'.time().'.'.$request->image->extension();
            $request->image->move(public_path('images/profiles/'), $imageName);        
        }
        $res=Admin::find($admin->id)->update([
            'image'=>'images/profiles/'.$imageName,
        ]);
        if($res)
        {
            return redirect()->back()->with('success','Profile Image Updated!');
        }
        return redirect()->back()->with('error','Profile Image not updated!');
    }
}
