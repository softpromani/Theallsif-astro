<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
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
}
