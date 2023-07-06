<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

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
        $data = $request->validate([
            'name' => 'required',
            // 'email' => 'required|unique:users|email,' . Auth::user()->id,
            'email' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id),
                'email',
            ],
        ]);
        $admin = Auth::user();
        if ($admin) {
            $adm = User::find($admin->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            return redirect()->back()->with('success', 'Profile Updated Successfully!');
        }
        return redirect()->back()->with('error', 'Profile not updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function profileImage(Request $request, $id)
    {
        $admin = Auth::user();

        if ($request->hasFile('pic')) {
            $emppic = 'emp-' . time() . '-' . rand(0, 99) . '.' . $request->pic->extension();

            $request->pic->move(public_path('upload/employees/'), $emppic);
            $oldpic = User::find($admin->id)->pluck('pic')[0];
            File::delete(public_path($oldpic));
            $res = User::find($admin->id)->update(['pic' => 'upload/employees/' . $emppic]);
            if ($res) {
                return redirect()->back()->with('success', 'Profile Image Updated!');
            }
        }

        // if ($request->hasFile('image')) {
        //     $imageName = 'Img-' . time() . '.' . $request->image->extension();
        //     $request->image->move(public_path('images/profiles/'), $imageName);
        // }
        // $res = Admin::find($admin->id)->update([
        //     'image' => 'images/profiles/' . $imageName,
        // ]);

        return redirect()->back()->with('error', 'Profile Image not updated!');
    }
}
