<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionName;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = PermissionName::all();
        return view('admin.permission', compact('permissions'));
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
        try {
            PermissionName::create(['name' => $request->name]);
            Permission::create(['name' => $request->name, 'guard_name' => 'web']);
            Permission::create(['name' => $request->name . '_create', 'guard_name' => 'web']);
            Permission::create(['name' => $request->name . '_edit', 'guard_name' => 'web']);
            Permission::create(['name' => $request->name . '_delete', 'guard_name' => 'web']);
            Permission::create(['name' => $request->name . '_read', 'guard_name' => 'web']);
            return redirect()->back()->with('success', 'Permission Added Successfully');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Permission Not Added ');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $editrole = Role::find($id);
        $roles = Role::all();
        $permissions = PermissionName::all();
        $editpermission = $editrole->permissions;
        return view('admin.user_permission', compact('roles', 'permissions', 'editpermission', 'editrole'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userPermission()
    {
        $roles = Role::all();
        $permissions = PermissionName::all();
        return view('admin.user_permission', compact('roles', 'permissions'));
    }

    public function assignPermission(Request $request)
    {
        Log::info('assignPermission' . json_encode($request->all()));
        $role = Role::where('id', $request->roleid)->first();
        if ($role->syncPermissions($request->permissionckbx)) {
            return redirect()->back()->with('success', 'Permission Granted Successfully');
        } else {
            return redirect()->back()->with('error', 'Permission not granted ');
        }
    }

    public function roleHasPermission()
    {
        $role = Role::all();
        $permissions = Permission::all();
        return view('admin.role_has_permission', compact('role', 'permissions'));
    }
}
