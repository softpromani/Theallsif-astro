<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Error;
use App\Models\User;
use App\Models\WebPage;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class AuthUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $roles = Role::all();
        $employees = User::get();
        return view('admin.employee', compact('employees', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'required',
            'password' => 'nullable',
            'roleid' => 'required',
            'pic' => 'image|nullable',
            'country_code' => 'required',
        ]);

        $phone = $request->country_code . $request->phone;
        try {
            $emppic = '';
            if ($request->hasFile('pic')) {
                $empic = 'emp-' . time() . '-' . rand(0, 99) . '.' . $request->pic->extension();
                $request->pic->move(public_path('upload/employees'), $empic);
                $emppic = 'upload/employees/' . $empic;
            }
            $hashpassword = Hash::make($request->password);
            $data = [
                'name' => $request->name,
                'phone' => $phone,
                'email' => $request->email,
                'password' => $hashpassword,
                'pic' => $emppic
            ];
            $role = Role::find($request->roleid);
            $res = User::create($data);
            if ($res) {
                $res->assignRole($role->name);
                return redirect()->back()->with('success', 'Employee Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Employee not added ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('admin.user-profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $employees = User::get();
        $id = Crypt::decrypt($id);
        $editemployee = User::find($id);
        if ($editemployee) {
            return view('admin.employee', compact('employees', 'editemployee', 'roles'));
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong OR Data is Deleted');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info('update' . json_encode($request->all()));
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'required',
            'roleid' => 'required',
            'pic' => 'image',
            'country_code' => 'required',
        ]);
        $phone = $request->country_code . $request->phone;
        try {
            if ($request->hasFile('pic')) {
                $emppic = 'emp-' . time() . '-' . rand(0, 99) . '.' . $request->pic->extension();
                $request->pic->move(public_path('upload/employees/'), $emppic);
                $oldpic = User::find($id)->pluck('pic')[0];
                File::delete(public_path($oldpic));
                User::find($id)->update(['pic' => 'upload/employees/' . $emppic]);
            }
            $data = [
                'name' => $request->name,
                'phone' => $phone,
                'email' => $request->email,
            ];
            $role = Role::find($request->roleid);
            $res = User::find($id)->update($data);

            if ($res) {
                User::find($id)->syncRoles($role->name);
                return redirect()->back()->with('success', 'Employee updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Employee not updated ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        try {
            $res = User::find($id)->delete();
            if ($res) {
                return redirect()->back()->with('success', 'Employee deleted ducessfully');
            } else {
                return redirect()->back()->with('error', 'Employee not deleted ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
        return redirect()->back();
    }

    public function changePassword()
    {
        // return view('admin.change-password');
    }

    public function updateProfile(Request $request)
    {
        // Log::info('update' . json_encode($request->all()));
        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'email' => 'required',
            'pic' => 'image'
        ]);
        try {
            if ($request->hasFile('pic')) {
                $emppic = 'emp-' . time() . '-' . rand(0, 99) . '.' . $request->pic->extension();
                $request->pic->move(public_path('upload/employees/'), $emppic);
                $oldpic = User::find($request->id)->pluck('pic')[0];
                File::delete(public_path($oldpic));
                User::find($request->id)->update(['pic' => 'upload/employees/' . $emppic]);
            }
            $data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email
            ];
            $res = User::find($request->id)->update($data);
            if ($res) {
                return redirect()->back()->with('success', 'User updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'User not updated ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'cnew_password' => 'required'
        ]);
        try {
            if ($request->new_password == $request->cnew_password) {
                $user = User::find($request->id);
                if (Hash::check($request->current_password, $user->password)) {
                    $res = User::find($request->id)->update(['password' => Hash::make($request->new_password)]);
                    if ($res) {
                        return redirect()->back()->with('success', 'Password changed Sucessfully');
                    } else {
                        return redirect()->back()->with('error', 'Password not changed ');
                    }
                } else {
                    return redirect()->back()->with('error', 'Incorrect current password');
                }
            } else {
                return redirect()->back()->with('error', 'Password did not matched ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }


    public function customer()
    {

        if (request()->ajax()) {
            $customers = Customer::where('role', 'customer')->latest()->get();
            return Datatables::of($customers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $ht = '';

                    if (Auth::user()->hasPermissionTo('customer_delete')) {
                        $ht .= '<a href="' . route("admin.delete", $row->id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa-sharp fa-solid fa-trash" style="color: #fa052a;"></i></a>';
                    }
                    return $ht;
                })
                ->rawColumns(['action',])
                ->make(true);
        }
        $role = auth()->user()->roles->first()->name;
        return view('admin.customer', compact('role'));
    }

    public function deleteCustomer($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            return redirect()->back()->with('danger', 'Customer deleted successfully!');
        }
        return redirect()->back()->with('danger', 'Customer not found.');
    }

    public function webPage($type = null)
    {

        if ($type != null) {
            $types = WebPage::where('type', $type)->first();
            if ($types != null) {
                $ty = $types->description;
            } else {
                $ty = null;
            }
            return $ty;
        } else {
            return view('admin.webpages.webpage');
        }
    }

    public function webpageUpdate(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);
        try {
            $res = WebPage::updateOrCreate(
                [
                    'type' => $request->type,
                ],
                [
                    'type' => $request->type,
                    'description' => $request->description,
                ]
            );
            if ($res) {
                return redirect()->back()->with('success', 'Page updated Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Page not updated ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }
}
