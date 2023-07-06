<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthUser;
use App\Models\Error;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.user_roles', compact('employees', 'roles'));
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
            'name' => 'required'
        ]);
        try {
            $res = Role::create(['name' => $request->name, 'guard_name' => 'web']);
            if ($res) {
                return redirect()->back()->with('success', 'Role Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Role not added ');
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
    public function show(Request $request)
    {
        //show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::get();
        $id = Crypt::decrypt($id);
        $editrole = Role::find($id);
        if ($editrole) {
            return view('admin.role', compact('roles', 'editrole'));
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
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $res = Role::find($id)->update(['name' => $request->name, 'guard_name' => 'web']);

            if ($res) {
                return redirect()->back()->with('success', 'Role Added Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Role not added ');
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
            $res = Role::find($id)->delete();
            if ($res) {
                return redirect()->back()->with('success', 'Role deleted ducessfully');
            } else {
                return redirect()->back()->with('error', 'Role not deleted ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function assignUserRole(Request $request)
    {
        $request->validate([
            'userid' => 'required',
            'roleid' => 'required'
        ]);
        try {
            $user = User::find($request->userid);
            $role = Role::find($request->roleid);
            // Assign role to user
            $res = $user->assignRole($role);

            if ($res) {
                return redirect()->back()->with('success', 'Role assigned Sucessfully');
            } else {
                return redirect()->back()->with('error', 'Role not assigned ');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            // Session::flash('error', 'Server Error ');
            return redirect()->back()->with('error', 'Server Error ');
        }
    }

    public function viewRole($id)
    {
        $id = Crypt::decrypt($id);
        $role = Role::find($id);
        return view('admin.view_role', compact('role'));
    }
}
