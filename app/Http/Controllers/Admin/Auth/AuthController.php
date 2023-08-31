<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Error;
use App\Models\Offer;
use App\Models\User;
use Exception;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // return 123;
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // return $request->all();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->route('admin.admin-dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Email and Password!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function changePassword(Request $request, $id)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required_with:new_password|same:new_password'

        ]);
        $admins = Auth::user();
        if (Hash::check($request->current_password, $admins->password)) {
            $admin = User::find($admins->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
            Auth::logout();
            return redirect()->route('login');
        }
        return redirect()->route('admin.admin-dashboard')->with('error', 'Current Password Invalid!');
    }

    public function loginUsingId($userId)
    {
        $userId = Crypt::decrypt($userId);
        $user = \App\Models\User::find($userId); // Find the user by ID

        // Get the superadmin's ID
        $superadminId = auth()->id();

        // Logout the superadmin
        auth()->logout();
        // Store the superadmin ID in the session
        Session::put('superadmin_id', $superadminId);
        if ($user) {
            Auth::loginUsingId($user->id); // Log in the user using ID
            return redirect()->route('admin.admin-dashboard'); // Redirect to the intended page after successful login
        }

        return redirect()->route('login')->with('error', 'Invalid user ID'); // Handle case where user is not found
    }

    public function offers()
    {
        // return  $blogs = Blog::first()->images->first()->img;
        if (request()->ajax()) {
            $offers = Offer::latest()->get();
            return Datatables::of($offers)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->offerimages->first()->img ?? '';
                    $img .= '" alt="Avatar" class="rounded-circle" /></div>';
                    return $img;
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
                        $ht .= '<a href="' . route("admin.offerEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('offer_delete')) {
                        $ht .= ' <form action="' . route("admin.offerDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'imagemedia'])
                ->make(true);
        }

        return view('admin.offer.offer_list');
    }

    public function offerStore(Request $request)
    {
        $request->validate([
            'offer_name' => 'required',
            'activate_date' => 'required',
            'deactivate_date' => 'required',
            'image' => 'image|required',
            'discount_type' => 'required',
            'offer_type' => 'required',
        ]);

        try {
            $offer_code = rand(11111, 99999) . time();

            $offer = Offer::create([
                'offer_name' => $request->offer_name,
                'activate_date' => $request->activate_date,
                'deactivate_date' => $request->deactivate_date,
                'offer_code' => $offer_code,
                'discount_type' => $request->discount_type,
                'discount' => $request->discount,
                'offer_type' => $request->offer_type,
                'max_discount_value' => $request->max_discount_value,
                'min_order_value' => $request->min_order_value,
                'user_id' => json_encode($request->user_id ?? []),
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image = ImageHelper::uploadImage($file, 'offer', 'offer');
                $offer->offerimages()->create($image);
            }

            if ($offer) {
                return redirect()->back()->with('success', 'Offer Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Offer not added ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function is_activeOffer(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $offer = Offer::find($id)->is_active;
        if ($offer == 1) {
            $update = Offer::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = Offer::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    public function offerEdit($id)
    {
        $id = Crypt::decrypt($id);
        if (request()->ajax()) {
            $offers = Offer::latest()->get();
            return Datatables::of($offers)
                ->addIndexColumn()
                ->addColumn('imagemedia', function ($image) {
                    $img = '<div class="avatar me-2">';
                    $img .= '<img src="';
                    $img .=  $image->offerimages->first()->img ?? '';
                    $img .= '" alt="Avatar" class="rounded-circle" /></div>';
                    return $img;
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
                        $ht .= '<a href="' . route("admin.offerEdit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                    }
                    if (Auth::user()->hasPermissionTo('offer_delete')) {
                        $ht .= ' <form action="' . route("admin.offerDelete", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this item?\')">
                            <i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i>
                        </button>';
                    }
                    return $ht;
                })
                // 
                ->rawColumns(['action', 'is_active', 'imagemedia'])
                ->make(true);
        }
        $edit = Offer::find($id);
        if ($edit->offer_type == 'Astrologer Wise') {
            $users = Customer::where('role', 'astrologer')->get();
        } else if ($edit->offer_type == 'Customer Wise') {
            $users = Customer::where('role', 'customer')->get();
        } else {
            $users = null;
        }

        return view('admin.offer.offer_edit', compact('edit', 'users'));
    }

    public function offerUpdate(Request $request, $id)
    {
        $request->validate([
            'offer_name' => 'required',
            'activate_date' => 'required',
            'deactivate_date' => 'required',
            'image' => 'image|nullable',
            'discount_type' => 'required',
            'offer_type' => 'required',
        ]);

        try {
            $res = Offer::find($id)->update([
                'offer_name' => $request->offer_name,
                'activate_date' => $request->activate_date,
                'deactivate_date' => $request->deactivate_date,
                'discount_type' => $request->discount_type,
                'discount' => $request->discount,
                'offer_type' => $request->offer_type,
                'max_discount_value' => $request->max_discount_value,
                'min_order_value' => $request->min_order_value,
                'user_id' => json_encode($request->user_id ?? []),
            ]);

            if ($request->hasFile('image')) {
                $offer = Offer::find($id);
                $md = $offer->offerimages->first();
                $imagePath = $md->path . $md->image_name;
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                $file = $request->file('image');
                $image = ImageHelper::uploadImage($file, 'offer', 'offer');
                $offer->offerimages()->update($image);
            }

            if ($res) {
                return redirect()->back()->with('success', 'Offer Updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Offer not Update ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function offerDelete($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $offer = Offer::find($id);

            if (isset($offer)) {
                $media = $offer->offerimages;
                if (isset($media)) {
                    foreach ($media as $md) {
                        $imagePath = $md->path . $md->image_name;
                        if (Storage::disk('public')->exists($imagePath)) {
                            Storage::disk('public')->delete($imagePath);
                        }
                        $md->delete();
                    }
                }
                $offer->delete();
                return redirect()->route('admin.offers')->with('error', 'Offer deleted successfully!');
            }
            return redirect()->back()->with('error', 'Offer not Found');
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }

    public function fetchCustomer($type)
    {
        try {
            if ($type == 'Astrologer Wise') {
                $res = Customer::where('role', 'astrologer')->get();
            } else if ($type == 'Customer Wise') {
                $res = Customer::where('role', 'customer')->get();
            } else {
                $res = null;
            }

            $html = ' <option value="">--Select Person--</option>';

            if ($res != null) {
                foreach ($res as $r) {
                    $html .= '<option value="' . $r->id . '">' . $r->name . '</option>';
                }
            }
            return response()->json($html);
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }
}
