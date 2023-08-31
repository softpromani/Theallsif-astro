<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Error;
use App\Models\WebConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Exception;
use DataTables;

class ComplaintController extends Controller
{
    public function socialLink()
    {
        $data = WebConfiguration::get()->groupBy('type');
        return view('admin.social.social_list', compact('data'));
    }

    public function sociallinkStore(Request $request)
    {

        try {
            $type = $request->type;
            $datas = $request->except('_token', 'type');
            foreach ($datas as $k => $data) {
                $socials = WebConfiguration::updateOrCreate(['key' => $k, 'type' => $type], ['value' => $data]);
            }
            if ($socials) {
                return redirect()->back()->with('success', 'Web Configuration Added Or Updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Web Configuration not added or update ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }


    public function complaint(Request $request, $complaint_type = Null)
    {
        if (request()->ajax()) {
            $query = Complaint::latest();
            if (request()->has('status')) {
                $statusFilter = request('status');
                if ($statusFilter != 'Select Status') {
                    $query->where('status', $statusFilter);
                }
            }
            $complaints = $query->get();
            return Datatables::of($complaints)
                ->addIndexColumn()
                ->addColumn('user_id', function ($row) {
                    $ht = '';
                    $ht .= $row->customer->name;
                    return $ht;
                })
                ->addColumn('user_type', function ($row) {
                    $ht = '';
                    $ht .= $row->customer->role;
                    return $ht;
                })
                ->addColumn('is_active', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '
                    <label class="switch switch-primary">
                    <input type="checkbox" class="switch-input is_active" data-id="' . $id . '"';
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
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    if (Auth::user()->hasPermissionTo('offer_edit')) {
                        $ht .= '<a href="' . route("admin.complaintEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('offer_delete')) {
                        $ht .= ' <form action="' . route("admin.complaintDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'user_id', 'user_type'])
                ->make(true);
        }

        return view('admin.complaint.complaint_list');
    }

    public function complaintStore(Request $request)
    {
        $request->validate([
            'complaint_disc' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);
        try {
            $ticket = 'CUST' . rand(0000, 9999) . time();
            $complaint = Complaint::create([
                'user_id' => $request->user_id,
                'complaint_disc' => $request->complaint_disc,
                'status' => $request->status,
                'complaint_ticket' => $ticket,
            ]);
            if ($complaint) {
                return redirect()->back()->with('success', 'Complaint Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Complaint not added ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function is_activeComplaint(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $complaint = Complaint::find($id)->is_active;
        if ($complaint == 1) {
            $update = Complaint::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = Complaint::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    public function complaintEdit($id)
    {
        $id = Crypt::decrypt($id);
        if (request()->ajax()) {
            $query = Complaint::latest();
            if (request()->has('status')) {
                $statusFilter = request('status');
                if ($statusFilter != 'Select Status') {
                    $query->where('status', $statusFilter);
                }
            }
            $complaints = $query->get();
            return Datatables::of($complaints)
                ->addIndexColumn()
                ->addColumn('user_id', function ($row) {
                    $ht = '';
                    $ht .= $row->customer->name;
                    return $ht;
                })
                ->addColumn('user_type', function ($row) {
                    $ht = '';
                    $ht .= $row->customer->role;
                    return $ht;
                })
                ->addColumn('is_active', function ($row) {
                    $id = Crypt::encrypt($row->id);
                    $ht = '
                    <label class="switch switch-primary">
                    <input type="checkbox" class="switch-input is_active" data-id="' . $id . '"';
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
                    $id = Crypt::encrypt($row->id);
                    $ht = '';
                    if (Auth::user()->hasPermissionTo('offer_edit')) {
                        $ht .= '<a href="' . route("admin.complaintEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('offer_delete')) {
                        $ht .= ' <form action="' . route("admin.complaintDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'user_id', 'user_type'])
                ->make(true);
        }
        $edit = Complaint::find($id);
        return view('admin.complaint.complaint_edit', compact('edit'));
    }

    public function complaintUpdate(Request $request, $id)
    {
        $request->validate([
            'complaint_disc' => 'required',
            'user_id' => 'required',
            'status' => 'required',
        ]);

        try {
            $res = Complaint::find($id)->update([
                'user_id' => $request->user_id,
                'complaint_disc' => $request->complaint_disc,
                'status' => $request->status,
            ]);


            if ($res) {
                return redirect()->back()->with('success', 'Complaint Updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Complaint not Update ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function complaintDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $complaint = Complaint::find($id);

            if (isset($complaint)) {
                $complaint->delete();
                return redirect()->route('admin.complaint')->with('error', 'Complaint deleted successfully!');
            }
            return redirect()->back()->with('error', 'Complaint not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }
}
