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
use App\Helpers\ImageHelper;
use App\Notifications\ServiceAgreements;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use App\Models\ServiceAgreement;
use Illuminate\Support\Facades\Notification;


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
                ->addColumn('service_by_admin', function ($row) {
                    $ht = '';
                    $ht .= '<a  class="btn btn-link p-0 service_by_admin "style="display:inline" data-id="' . $row->id . '"><button type="button" class="btn btn-sm btn-primary">Upload</button></a>';
                    return $ht;
                })
                ->addColumn('service_admin_download', function ($row) {
                    $ht = '';
                    $imagePath = $row->serviceAgreement->agreement_by_admin ?? '';

                    if ($imagePath == null) {
                        $downloadLink = asset($imagePath);
                        $ht .= '<a class="btn btn-link p-0  "style="display:inline" data-id="' . $row->id . '"><button type="button" class="btn btn-sm btn-primary" disabled>Download </button></a>';
                    } else {
                        $downloadLink = asset($imagePath);
                        $ht .= '<a href="' . $downloadLink . '" download class="btn btn-link p-0  "style="display:inline" data-id="' . $row->id . '"><button type="button" class="btn btn-sm btn-primary">Download</button></a>';
                    }
                    return $ht;
                })
                ->addColumn('service_by_astrologer', function ($row) {
                    $ht = '';
                    $ht .= '<a  class="btn btn-link p-0 service_by_astrologer "style="display:inline" data-id="' . $row->id . '"><button type="button" class="btn btn-sm btn-primary">Upload</button></a>';
                    return $ht;
                })
                ->addColumn('service_astrologer_download', function ($row) {
                    $ht = '';
                    $imagePath = $row->serviceAgreement->agreement_by_astrologer ?? '';

                    if ($imagePath == null) {
                        $downloadLink = asset($imagePath);
                        $ht .= '<a class="btn btn-link p-0  "style="display:inline" data-id="' . $row->id . '"><button type="button" class="btn btn-sm btn-primary" disabled>Download </button></a>';
                    } else {
                        $downloadLink = asset($imagePath);
                        $ht .= '<a href="' . $downloadLink . '" download class="btn btn-link p-0  "style="display:inline" data-id="' . $row->id . '"><button type="button" class="btn btn-sm btn-primary">Download</button></a>';
                    }
                    return $ht;
                })
                ->rawColumns(['action', 'is_active', 'service_by_admin', 'service_by_astrologer', 'service_astrologer_download', 'service_admin_download'])
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
                $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="astrologer_id" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="' . $id . '"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="payment_call" class="form-label">Astrologer Call/Min Cost</label>
                        <input type="number" class="form-control" id="payment_call" name="payment_call" value="';
                        $view .=$cost->payment_call??0.00;
                        $view .='" step="0.01">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="payment_chat" class="form-label">Astrologer Chat/Min Cost</label>
                        <input type="number" class="form-control" id="payment_chat" name="payment_chat" value="';
                        $view .=$cost->payment_chat??0;
                        $view .='" step="0.01">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="admin_charge" class="form-label">Admin Charge (in percentage)</label>
                        <input type="number" class="form-control" id="admin_charge" name="admin_charge" value="';
                        $view .=$cost->admin_charge??0 ;
                        $view .='">
                    </div>
                </div>
            </div>
       ';
            
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
            'payment_call' => 'required',
            'payment_chat' => 'required',
            'admin_charge'=>'required'
        ]);
        try {
            $res = AstrologerCost::updateOrCreate(
                [
                    'astrologer_id' => $request->astrologer_id,
                ],
                [
                    'astrologer_id' => $request->astrologer_id,
                    'payment_chat' => $request->payment_chat,
                    'payment_call' => $request->payment_call,
                    'admin_charge'=>$request->admin_charge
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

    public function serviceAgreementadmin($id)
    {
        try {
            $service_agreement = ServiceAgreement::where('astrologer_id', $id)->first();

            $view = '';
            if ($service_agreement != null) {
                $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="role" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="role" name="role" value="' . Auth::user()->roles[0]->name . '"/>
                    </div>
                </div>
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="astrologer_id" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="' . $id . '"/>
                    </div>
                </div>
                <div class="col-md-8">
                <div class="col-2"> <img src="' . asset($service_agreement->agreement_by_admin) . '" alt="" srcset="" height="50px" width="50px"></div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
               </div>
            </div>
       ';
            } else {
                $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="astrologer_id" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="' . $id . '"/>
                    </div>
                </div>
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" value="' . Auth::user()->roles[0]->name . '"/>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
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

    public function serviceAgreementastro($id)
    {
        try {
            $service_agreement = ServiceAgreement::where('astrologer_id', $id)->first();

            $view = '';
            if ($service_agreement != null) {
                $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="role" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="role" name="role" value="' . Auth::user()->roles[0]->name . '"/>
                    </div>
                </div>
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="astrologer_id" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="' . $id . '"/>
                    </div>
                </div>
                <div class="col-md-8">
                <div class="col-2"> <img src="' . asset($service_agreement->agreement_by_astrologer) . '" alt="" srcset="" height="50px" width="50px"></div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
               </div>
            </div>
       ';
            } else {
                $view .= '<div class="row">
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="astrologer_id" class="form-label">Astrologer Id</label>
                        <input type="text" class="form-control" id="astrologer_id" name="astrologer_id" value="' . $id . '"/>
                    </div>
                </div>
                <div class="col-md-6" hidden>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" value="' . Auth::user()->roles[0]->name . '"/>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
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

    public function storeServiceAgreementadmin(Request $request)
    {

        $request->validate([
            'astrologer_id' => 'required',
            'image' => 'required|mimes:pdf,jpg',
        ]);
        $service_agreement = ServiceAgreement::where('astrologer_id', $request->astrologer_id)->first();

        try {
            if ($service_agreement != null) {
                if ($request->hasFile('image')) {
                    // Delete the old image if it exists
                    if ($service_agreement->agreement_by_admin) {
                        $oldImagePath = public_path($service_agreement->agreement_by_admin);
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }
                    $img = 'service_agreement-' . time() . '-' . rand(0, 99) . '.' . $request->image->extension();
                    $request->image->move(public_path('upload/service_agreement'), $img);

                    $agreement = ServiceAgreement::where('astrologer_id', $request->astrologer_id)->update([
                        'agreement_by_admin' => 'upload/service_agreement/' . $img,
                    ]);
                }
                $agreement1 = ServiceAgreement::where('astrologer_id', $request->astrologer_id)->first();
                if ($agreement1->update(['uploaded_by' => Auth::user()->id])) {
                    $message['title'] = 'Your Service Argeement Uploded By ' . Auth::user()->name . '';
                    $message['body'] = 'Download and upload your verification : ';
                    // $agreement1->notify(new ServiceAgreements($message));
                    Notification::send($service_agreement, new ServiceAgreements($message));
                    return redirect()->back()->with('success', 'Astrologer Service Agreement Upload Updated by Admin Sucessfully!');
                } else {
                    return redirect()->back()->with('error', 'Astrologer Service Agreement Upload Not Update by Admin!');
                }
            } else {
                if ($request->hasFile('image')) {
                    $img = 'service_agreement-' . time() . '-' . rand(0, 99) . '.' . $request->image->extension();
                    $request->image->move(public_path('upload/service_agreement'), $img);
                }
                $agreement = ServiceAgreement::create([
                    'astrologer_id' => $request->astrologer_id,
                    'uploaded_by' => Auth::user()->id,
                    'agreement_by_admin' => 'upload/service_agreement/' . $img,
                ]);
                if ($agreement) {
                    $message['title'] = 'Your Service Argeement Uploded By ' . Auth::user()->name . '';
                    $message['body'] = 'Download And Upload Your Verification ?';
                    // $agreement->notify(new ServiceAgreements($message));
                    Notification::send($agreement, new ServiceAgreements($message));
                    return redirect()->back()->with('success', 'Astrologer Service Agreement Uploaded by Admin Sucessfully!');
                } else {
                    return redirect()->back()->with('error', 'Astrologer Service Agreement Not Upload by Admin!');
                }
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function storeServiceAgreementastro(Request $request)
    {

        $request->validate([
            'astrologer_id' => 'required',
            'image' => 'required|mimes:pdf,jpg',
        ]);

        $service_agreement = ServiceAgreement::where('astrologer_id', $request->astrologer_id)->first();

        try {
            if ($service_agreement != null) {
                if ($request->hasFile('image')) {
                    // Delete the old image if it exists
                    if ($service_agreement->agreement_by_astrologer) {
                        $oldImagePath = public_path($service_agreement->agreement_by_astrologer);
                        if (File::exists($oldImagePath)) {
                            File::delete($oldImagePath);
                        }
                    }
                    $img = 'service_agreement-' . time() . '-' . rand(0, 99) . '.' . $request->image->extension();
                    $request->image->move(public_path('upload/service_agreement'), $img);

                    $agreement = ServiceAgreement::where('astrologer_id', $request->astrologer_id)->update([
                        'agreement_by_astrologer' => 'upload/service_agreement/' . $img,
                    ]);
                }
                $agreement1 = ServiceAgreement::where('astrologer_id', $request->astrologer_id)->first();
                if ($agreement1->update(['uploaded_by' => Auth::user()->id])) {
                    return redirect()->back()->with('success', 'Astrologer Service Agreement Upload Updated by Astrologer Sucessfully!');
                } else {
                    return redirect()->back()->with('error', 'Astrologer Service Agreement Upload Not Update by Astrologer!');
                }
            } else {
                if ($request->hasFile('image')) {
                    $img = 'service_agreement-' . time() . '-' . rand(0, 99) . '.' . $request->image->extension();
                    $request->image->move(public_path('upload/service_agreement'), $img);
                }
                $agreement = ServiceAgreement::create([
                    'astrologer_id' => $request->astrologer_id,
                    'uploaded_by' => Auth::user()->id,
                    'agreement_by_astrologer' => 'upload/service_agreement/' . $img,
                ]);
                if ($agreement) {
                    return redirect()->back()->with('success', 'Astrologer Service Agreement Uploaded  by Astrologer Sucessfully!');
                } else {
                    return redirect()->back()->with('error', 'Astrologer Service Agreement Not Upload by Astrologer!');
                }
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
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
