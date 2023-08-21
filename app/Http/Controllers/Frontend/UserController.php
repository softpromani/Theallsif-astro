<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Astrologer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function sendOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'country_code' => 'required',
            // 'referral_code' => 'required',
        ]);
        $phone = $request->country_code . $request->phone;
        $otp = rand(1000, 9999);
        $expiryTime = Carbon::now()->addMinutes(5);
        $user = Customer::updateOrCreate(
            [
                'phone' => $phone,
            ],
            [
                'phone' => $phone,
                'otp' => $otp,
                'expires_at' => $expiryTime,
            ]
        );
        $referral = Customer::where('phone', $phone)->first()->referral_code;
        if ($referral == null) {
            $code = time() . rand(1, 99);
            Customer::find($user->id)->update([
                'referral_code' => $code,
            ]);
        }
        if ($request->referral_code != null) {
            $referral_id = Customer::where('referral_code', $request->referral_code)->first();
            Customer::find($user->id)->update([
                'referral_id' => $referral_id->id,
            ]);
        }

        return response()->json([
            'user' => $user,
            'phone' => $request->phone,
            'country_code' => $request->country_code,
        ]);
    }

    public function verifyOTP(Request $request)
    {

        $enteredOTP = $request->otp;
        $user = Customer::where('phone', $request->phone_number)->first();

        if ($user && $user->otp === $enteredOTP) {
            // Check if the OTP is still valid (i.e., not expired)
            if (now()->lt($user->expires_at)) {
                // OTP is valid, proceed with the login process
                // Set authenticated user and redirect to the desired page
                $login = Auth::guard('customer')->loginUsingId($user->id);
                return response()->json([
                    'role' => $user->role,
                ]);
            }
        }
        return response()->json([
            'otp' => 'Invalid or expired OTP',
            'role' => $user->role,
        ]);
    }


    public function logout()
    {
        Auth::guard('customer')->logout();
        Auth::logout();
        return redirect()->route('home');
    }

    public function updateProfile(Request $request, $id)
    {

        $request->validate([
            'phone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);
        if ($request->role == 'customer') {

            $user = Customer::find($id)->update(
                [
                    'dob_time' => $request->dob_time,
                    'dob' => $request->dob,
                ]
            );
        }


        $image = Customer::find($id);
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

            $data = Customer::find($id)->update([
                'image' => $imageName,
            ]);
            if ($request->astrologer_id != null) {
                Astrologer::where('id', $request->astrologer_id)->update([
                    'image' => $imageName,
                ]);
            }
        }

        if ($request->astrologer_id != null) {
            Astrologer::where('id', $request->astrologer_id)->update([
                'phone' => $request->phone,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
            ]);
        }
        $name = $request->first_name . ' ' . $request->last_name;
        // var_dump($name);
        // die;
        $user = Customer::find($id)->update(
            [
                'phone' => $request->phone,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'name' => $name,
                'is_profile' => true,
            ]
        );
        if (isset($user)) {
            return redirect()->back()->with('success', 'Profile Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Profile Not Update Successfully');
        }
    }
}
