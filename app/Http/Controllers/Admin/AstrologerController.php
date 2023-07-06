<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Astrologer;
use Illuminate\Support\Facades\File;
use DataTables;
use Illuminate\Support\Facades\Auth;

class AstrologerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $astrogers = Astrologer::latest()->get();
            return Datatables::of($astrogers)
                ->addIndexColumn()
                ->addColumn('experties', function ($row) {
                    return json_decode($row->experties, true);
                })
                ->addColumn('language', function ($row) {
                    return json_decode($row->language, true);
                })
                ->addColumn('is_active', function ($row) {
                    $ht = '
                    <label class="switch switch-primary">
                    <input type="checkbox" class="switch-input is_active" data-id="' . $row->id . '"';
                    $ht .= ($row->is_active == 1) ? 'checked' : '';
                    $ht .= '>
                    <span class="switch-toggle-slider">
                      <span class="switch-on">
                        <i class="ti ti-check"></i>
                      </span>
                      <span class="switch-off">
                        <i class="ti ti-x"></i>
                      </span>
                    </span>
                  </label>';
                    return $ht;
                })
                ->addColumn('action', function ($row) {
                    $ht = '';
                    if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                        $ht .= '<a href="' . route("admin.astrologer.edit", $row->id) . '" class="btn btn-link p-0 switch"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('astrologer_delete')) {
                        $ht .= ' <form action="' . route("admin.astrologer.destroy", $row->id) . '" method="post" style="display:inline">
                            ' . method_field("DELETE") . '
                            ' . csrf_field() . '
                            <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                                <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                            </button>';
                    }
                    return $ht;
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
        }
        return view('admin.astrologer.astrologer');
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
            'state' => 'required',
            'city' => 'required',
            'image' => 'required|image',
        ]);
        if ($request->hasFile('image')) {
            $imageName = 'Img' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $experties = $request->experties ?? [];
        $expertiesJson = json_encode($experties);
        $language = $request->language ?? [];
        $languageJson = json_encode($language);
        $data = Astrologer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'image' => $imageName,
            'experties' => $expertiesJson,
            'language' => $languageJson,
            'description' => $request->description,
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
        $edit = Astrologer::find($id);
        return view('admin.astrologer.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'image' => 'nullable|image'
        ]);
        $image = Astrologer::find($id);
        $oldImagePath = public_path('images/' . $image->image);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($image->image) {
                $oldImagePath = public_path('images/' . $image->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            $imageName = 'Img' . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $data = Astrologer::find($id)->update([
                'image' => $imageName,
            ]);
        }
        $experties = $request->experties ?? [];
        $expertiesJson = json_encode($experties);

        $language = $request->language ?? [];
        $languageJson = json_encode($language);
        $data = Astrologer::find($id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'experties' => $expertiesJson,
            'language' => $languageJson,
            'description' => $request->description,
        ]);
        if ($data) {

            return redirect()->route('admin.astrologer.index')->with('success', 'Astrologer Update successfully!.');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $astroger = Astrologer::find($id);
        if ($astroger) {
            $imagePath = public_path('images/' . $astroger->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $astroger->delete();
            return redirect()->back()->with('danger', 'Astrologer deleted successfully!');
        }
        return redirect()->back()->with('danger', 'Astrologer not found.');
    }

    public function is_active(Request $request, $id)
    {
        $astrologer = Astrologer::find($id)->is_active;
        if ($astrologer == 1) {
            $update = Astrologer::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = Astrologer::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }
}
