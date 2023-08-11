<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Astrologer;
use App\Models\AstrologerCost;
use App\Models\Customer;
use App\Models\Error;
use Illuminate\Support\Facades\File;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AstrologerExport;


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
                    $ht .= '<a  class="btn btn-link p-0 comment_dollar "style="display:inline" data-id="' . $row->id . '"><i class="fa-sharp fa-solid fa-comments-dollar"></i></a>';
                    if (Auth::user()->hasPermissionTo('astrologer_edit')) {
                        $ht .= '<a href="' . route("admin.astrologer.edit", $row->id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
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
            'experience' => 'required',
            'education' => 'required',
            'country_code' => 'required',
            'father_name' => 'required',
            'pin_code' => 'required',
            'dob_place' => 'required',
            'dob' => 'required',
            'dob_time' => 'required',
            'gender' => 'required',
        ]);

        $phone = $request->country_code . $request->phone;
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
            'phone' => $phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'image' => $imageName,
            'experties' => $expertiesJson,
            'language' => $languageJson,
            'description' => $request->description,
            'experience' => $request->experience,
            'education' => $request->education,

            'father_name' => $request->father_name,
            'pin_code' => $request->pin_code,
            'dob_place' => $request->dob_place,
            'dob_time' => $request->dob_time,
            'gender' => $request->gender,
            'dob' => $request->dob,


        ]);
        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'astrologer_id' => $data->id,
            'image' => $imageName,
            'role' => 'astrologer',

            'father_name' => $request->father_name,
            'pin_code' => $request->pin_code,
            'dob_place' => $request->dob_place,
            'dob_time' => $request->dob_time,
            'gender' => $request->gender,
            'dob' => $request->dob,
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
            'image' => 'nullable|image',
            'experience' => 'required',
            'education' => 'required',
            'country_code' => 'required',

            'father_name' => 'required',
            'pin_code' => 'required',
            'dob_place' => 'required',
            'dob' => 'required',
            'dob_time' => 'required',
            'gender' => 'required',
        ]);
        $phone = $request->country_code . $request->phone;
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

            Customer::where('astrologer_id', $id)->update([
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
            'phone' => $phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'experties' => $expertiesJson,
            'language' => $languageJson,
            'description' => $request->description,
            'experience' => $request->experience,
            'education' => $request->education,

            'father_name' => $request->father_name,
            'pin_code' => $request->pin_code,
            'dob_place' => $request->dob_place,
            'dob_time' => $request->dob_time,
            'gender' => $request->gender,
            'dob' => $request->dob,
        ]);
        Customer::where('astrologer_id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $phone,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,

            'father_name' => $request->father_name,
            'pin_code' => $request->pin_code,
            'dob_place' => $request->dob_place,
            'dob_time' => $request->dob_time,
            'gender' => $request->gender,
            'dob' => $request->dob,
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
        Customer::where('astrologer_id', $id)->delete();
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

    public function costHr(Request $request, $id)
    {
        try {
            $cost = AstrologerCost::where('astrologer_id', $id)->first();
            // dd($cost);
            $view = '';
            if ($cost != null) {
                $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="astrologer_id" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="' . $id . '"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="payment" class="form-label">Astrologer Cost/Min</label>
                        <input type="text" class="form-control" id="payment" name="payment" value="' . $cost->astrologer_cost . '">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="payment" class="form-label">Admin Cost/Min</label>
                        <input type="text" class="form-control" id="admin_payment" name="admin_payment" value="' . $cost->admin_cost . '">
                    </div>
                </div>
            </div>
       ';
            } else {
                $view .= '<div class="row">
                <div class="col-md-6" hidden >
                    <div class="mb-3">
                        <label for="astrologer_id" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="' . $id . '"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="payment" class="form-label">Astrologer Cost/Min</label>
                        <input type="text" class="form-control" id="payment" name="payment"/>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                    <label for="payment" class="form-label">Admin Cost/Min</label>
                    <input type="text" class="form-control" id="admin_payment" name="admin_payment"/>
                </div>
            </div>
            </div>
       ';
            }
            return $view;
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }


    public function storeCostHr(Request $request)
    {
        $request->validate([
            'astrologer_id' => 'required',
            'payment' => 'required',
            'admin_payment' => 'required',
        ]);
        try {
            $res = AstrologerCost::updateOrCreate(
                [
                    'astrologer_id' => $request->astrologer_id,
                ],
                [
                    'astrologer_id' => $request->astrologer_id,
                    'astrologer_cost' => $request->payment,
                    'admin_cost' => $request->admin_payment,
                ]
            );
            if ($res) {
                return response()->json([
                    'message' => 'Astrologer Cost updated Sucessfully!',
                    'data' =>  $res
                ]);
            } else {
                return response()->json([
                    'message' => 'Astrologer Cost not updated !',
                    'data' => $res
                ]);
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function exportAstrologer()
    {
        $fields = ['first_name', 'last_name', 'email', 'phone', 'country', 'state', 'city', 'description', 'experties', 'language', 'image', 'experience', 'education', 'father_name', 'pin_code', 'dob_place', 'dob_time', 'dob', 'gender'];
        return Excel::download(new AstrologerExport($fields), 'Astrologer list.xlsx');
    }

    // public function uploadCsv(Request $request)
    // {
    //     $request->validate([
    //         // 'csv_file' => 'required|mimes:csv|max:2048', // Validate file type and size
    //     ]);
    //     // dd($request->all());
    //     if ($request->hasFile('csv_file')) {
    //         $csvFile = $request->file('csv_file');
    //         $csvData = file($csvFile->path()); // Read all lines from the CSV file
    //         foreach ($csvData as $index => $line) {
    //             if ($index === 0) {
    //                 continue;
    //             }
    //             $row = str_getcsv($line); // Parse the CSV line
    //             $astro = Astrologer::create([
    //                 'first_name' => $row[0],
    //                 'last_name' => $row[1],
    //                 'email' => $row[2],
    //                 'phone' => $row[3],
    //                 'country' => $row[4],
    //                 'state' => $row[5],
    //                 'city' => $row[6],
    //                 'description' => $row[7],
    //                 'experties' => $row[8],
    //                 'education' => $row[9],
    //                 'father_name' => $row[10],
    //                 'pin_code' => $row[11],
    //                 'dob_place' => $row[12],
    //                 'dob_time' => $row[13],
    //                 'dob' => $row[14],
    //                 'gender' => $row[15],
    //                 'language' => $row[16],
    //                 'experience' => $row[17],
    //             ]);


    //             Customer::create([
    //                 'first_name' => $row[0],
    //                 'last_name' => $row[1],
    //                 'email' => $row[2],
    //                 'phone' => $row[3],
    //                 'country' => $row[4],
    //                 'state' => $row[5],
    //                 'city' => $row[6],
    //                 'astrologer_id' => $astro->id,
    //                 'role' => 'astrologer',
    //                 'father_name' => $row[10],
    //                 'pin_code' => $row[11],
    //                 'dob_place' => $row[12],
    //                 'dob_time' => $row[13],
    //                 'dob' => $row[14],
    //                 'gender' => $row[15],
    //             ]);
    //         }
    //     }

    //     return redirect()->back()->with('success', 'CSV uploaded and data processed.');
    // }
}
