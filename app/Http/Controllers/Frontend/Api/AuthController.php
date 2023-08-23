<?php

namespace App\Http\Controllers\Frontend\Api;

use App\Http\Controllers\Controller;
use App\Models\Astrologer;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public $successStatus = 200;
    public $valerrorStatus = 500;
    public $errorStatus = 401;
    public function generate(Request $request)
    {
        $rules = [

            'phone'            => 'required|min:7'

        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response(['success' => false, 'code' => $this->valerrorStatus, 'message' => $validation->errors()->first()], $this->valerrorStatus);
        }

        if (!User::where('phone', $request->phone)->first()) {
            $add = new User;
            $add->phone = $request->phone;
            $add->otp = rand(100000, 999999);
            $add->save();
            // $apiToken=$add->createToken('auth_token')->accessToken;
            $apiToken = "11hsvdkhdvhdsvshjjkvdhfvsfhsfvhdfsdh";
            $user = User::where('phone', $request->phone)->first();
            return response(['success' => true, 'code' => $this->successStatus, 'message' => 'OTP sent to above mobile number', 'user' => $user, 'token' => $apiToken], $this->successStatus);
        } else {
            $update['otp'] = rand(100000, 999999);
            $detail = User::where('phone', $request->phone)->update($update);
            $user = User::where('phone', $request->phone)->first();
            // $apiToken=$user->createToken('token')->accessToken;
            $apiToken = "11hsvdkhdvhdsvshjjkvdhfvsfhsfvhdfsdh";
            return response(['success' => true, 'code' => $this->successStatus, 'message' => 'OTP sent to above mobile number', 'user' => $user, 'token' => $apiToken], $this->successStatus);
        }
    }

    public function otp_verification(Request $request)
    {

        $rules = [

            'user_id'  => 'required',

            'otp'      => 'required|min:4'

        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response(['status' => false, 'statuscode' => 200, 'massage' => $validation->errors()->first()]);
        }

        $user = User::where(['id' => $request->user_id])->first();
        if ($user) {
            if (123456 == $request->otp) {
                $update['otp'] = null;
                $detail = User::where('id', $user->id)->update($update);
                // $token = $user->createToken( env( 'ACCESS_TOKEN' ) )->accessToken;
                $token = "11hsvdkhdvhdsvshjjkvdhfvsfhsfvhdfsdh";
                $user_details = User::where('id', $user->id)->first();
                return response(['status' => true, 'statuscode' => 200, 'massage' => 'Otp verification successful', 'data' => $user, '_access_token' => $token]);
            } else {
                return response(['status' => false, 'statuscode' => 200, 'massage' => 'Wrong otp'], 200);
            }
        }
        return response(['status' => false, 'statuscode' => 200, 'massage' => 'Wrong user Id'], 200);
    }



    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        return response()->json(['profile' => $profile], 200);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $request->validate([
            'full_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            // Add validation rules for other fields as needed
        ]);

        $profile->update($request->all());

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    //     public function generateOtp($phone)
    //     {
    //         $user = User::where('phone', $phone)->first();

    //         /* User Does not Have Any Existing OTP */
    //         $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();

    //         $now = now();

    //         if($userOtp && $now->isBefore($userOtp->expire_at)){
    //             return $userOtp;
    //         }

    //         /* Create a New OTP */
    //         return UserOtp::create([
    //             'user_id' => $user->id,
    //             'otp' => rand(123456, 999999),
    //             'expire_at' => $now->addMinutes(10)
    //         ]);
    //     }

    //     /**
    //      * Write code on Method
    //      *
    //      * @return response()
    //      */
    public function verification($user_id)
    {
        return response()->json([
            'user_id' => $user_id
        ], 200);
    }

    //     /**
    //      * Write code on Method
    //      *
    //      * @return response()
    //      */
    public function loginWithOtp(Request $request)
    {
        /* Validation */

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fails',
                'error' => $validator->errors()
            ], 422);
        }


        /* Validation Logic */
        $userOtp   = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = now();
        if (!$userOtp) {
            return response()->json([
                'message' => 'Your OTP is not correct'
            ], 400);
        } else if ($userOtp && $now->isAfter($userOtp->expire_at)) {
            return response()->json([
                'message' => 'Your OTP has been expired'
            ], 400);
        }

        $user = User::whereId($request->user_id)->first();

        if ($user) {

            $userOtp->update([
                'expire_at' => now()
            ]);

            Auth::login($user);

            return response()->json([
                'message' => 'Login Successfully',
                'data' => $user
            ], 200);
        }
        return response()->json([
            'message' => 'Your Otp is not correct'
        ], 400);
    }
    //     public function change_password(Request $request)
    //     {   
    //          $validator = Validator::make($request->all(), [
    //         'user_id'=> 'required|exists:users,id',
    //         'old_password'=>'required',
    //         'new_password'=>'required',
    //         'new_confirm_password'=>'same:new_password|required',

    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //             if (Hash::check($request->old_password, User::find($request->user_id)->password)) {
    //                 $data = User::find($request->user_id)->update([
    //                     'password' => Hash::make($request->new_password),
    //                 ]);
    //                 $res = [
    //                     'message' => 'your password is updated successfully !',
    //                     'success' => true
    //                 ];
    //             } else {
    //                 $res = [

    //                     'message' => 'your old password is not mached !',
    //                     'success' => false
    //                 ];
    //             }

    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }

    // public function reset_password(Request $request)
    //     {   
    //          $validator = Validator::make($request->all(), [
    //         'phone_no'=> 'required|exists:users,phone',
    //         'user_id'=>'required',
    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //             if ($request->phone_no) {
    //                   $otp = rand(100000, 999999);
    //           $args = http_build_query(array(
    //               'auth_token'=> '7e67f6dec74c3357f953a1f78b4041ce63c65c7bc5c998b10ecd21e226b64338',
    //               'to'    => $request->phone_no,
    //               'text'  => 'Your OTP Code for registration in foodybazar is: '.$otp));
    //           $url = "https://sms.aakashsms.com/sms/v3/send/";

    //           # Make the call using API.
    //           $ch = curl_init();
    //           curl_setopt($ch, CURLOPT_URL, $url);
    //           curl_setopt($ch, CURLOPT_POST, 1); ///
    //           curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
    //           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //           // Response
    //           $response = curl_exec($ch);
    //           curl_close($ch);
    //                   $data=UserOtp::create([
    //                       'user_id'=>$request->user_id,
    //                       'otp'=>$otp,
    //                       'expire_at'=>Carbon::now()->addMinutes(10),
    //                       ]);


    //                 $res = [
    //                     'message' => 'password reset successfully !',
    //                     'data'=>$otp,
    //                     'success' => true,
    //                 ];
    //             } else {
    //                 $res = [
    //                     'message' => 'password not reset !',
    //                     'success' => false
    //                 ];
    //             }
    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }

    // public function verify_otp(Request $request)
    //     {   

    //          $validator = Validator::make($request->all(), [
    //         'otp'=> 'required|exists:user_otps,otp',
    //         'user_id'=>'required',
    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //             if (UserOtp::where('user_id',$request->user_id)->where('otp',$request->otp)->exists()) {

    //                 $res = [
    //                     'type'=>$request->type,
    //                     'message' => 'Otp verified successfully !',
    //                     'success' => true,
    //                 ];
    //             } else {
    //                 $res = [
    //                     'message' => 'Invalid otp!',
    //                     'success' => false
    //                 ];
    //             }
    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }


    // public function set_new_password(Request $request)
    //     {   
    //          $validator = Validator::make($request->all(), [
    //           'new_password'=>'required',
    //           'confirm_new_password'=>'same:new_password',
    //         'user_id'=>'required',
    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //           $res= User::find($request->user_id)->update([
    //                 'password'=>Hash::make($request->new_password),
    //                 ]);

    //             if ($res) {

    //                 $res = [
    //                     'message' => 'Password change successfully !',
    //                     'success' => true,
    //                 ];
    //             } else {
    //                 $res = [
    //                     'message' => 'Password not changed!',
    //                     'success' => false
    //                 ];
    //             }
    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }

    //   public function login_by_password(Request $request)
    //     {   
    //          $validator = Validator::make($request->all(), [
    //         'user_id'=> 'required|exists:users,id',
    //         'password'=>'required',
    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //             if (Hash::check($request->password, User::find($request->user_id)->password)) {
    //                 $res = [
    //                     'message' => 'Login successfully !',
    //                     'success' => true
    //                 ];
    //             } else {
    //                 $res = [

    //                     'message' => 'your password is not mached !',
    //                     'success' => false
    //                 ];
    //             }

    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }


    // public function generate_otp(Request $request)
    //     {   
    //          $validator = Validator::make($request->all(), [
    //         'phone_no'=> 'required',
    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //             if (User::where('phone',$request->phone_no)->exists()) {
    //                     $data=User::where('phone',$request->phone_no)->get();
    //                 $res = [
    //                     'type'=>'login',
    //                     'message' => 'Login  successfully !',
    //                     'data'=>$data,
    //                     'success' => true,
    //                 ];
    //             } 


    //             else {
    //                   $otp = rand(100000, 999999);
    //           $args = http_build_query(array(
    //               'auth_token'=> '7e67f6dec74c3357f953a1f78b4041ce63c65c7bc5c998b10ecd21e226b64338',
    //               'to'    => $request->phone_no,
    //               'text'  => 'Your OTP Code for registration in foodybazar is: '.$otp));
    //           $url = "https://sms.aakashsms.com/sms/v3/send/";

    //           # Make the call using API.
    //           $ch = curl_init();
    //           curl_setopt($ch, CURLOPT_URL, $url);
    //           curl_setopt($ch, CURLOPT_POST, 1); ///
    //           curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
    //           curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //           // Response
    //           $response = curl_exec($ch);
    //           curl_close($ch);
    //                   UserOtp::create([
    //                       'phone_no'=>$request->phone_no,
    //                       'otp'=>$otp,
    //                       'expire_at'=>Carbon::now()->addMinutes(10),
    //                       ]);


    //                 $res = [
    //                     'type'=>'Register',
    //                     'message' => 'otp generate successfully !',
    //                     'phone_no'=>$request->phone_no,
    //                     'data'=>$otp,
    //                     'success' => true,
    //                 ];
    //             }
    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }

    // public function verify_login_otp(Request $request)
    //     {   

    //          $validator = Validator::make($request->all(), [
    //         'otp'=> 'required|exists:user_otps,otp',
    //         'phone_no'=>'required',
    //       'type'=>'required',
    //     //   'password'=>'required',
    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //             if (UserOtp::where('phone_no',$request->phone_no)->where('otp',$request->otp)->exists()) {
    //                   if(User::where('phone',$request->phone_no)->exists()){
    //                       $data= User::where('phone',$request->phone_no)->get();
    //                       $res = [
    //                           'data'=> $data,
    //                     'type'=>$request->type,
    //                     'message' => 'login successfully !',
    //                     'success' => true,
    //                 ];
    //                   }
    //                 else{

    //                  $data=User::create([
    //                   'phone'=>$request->phone_no,
    //                 //   'password'=>Hash::make($request->password)
    //                   ]);

    //                   UserDetail::create([
    //                       'customer_id'=>$data->id,
    //                       'phone'=>$request->phone_no,
    //                     ]);


    //                 $res = [
    //                     'data'=> $data,
    //                     'message' => 'Register successfully !',
    //                     'type'=>$request->type,
    //                     'success' => true,
    //                 ];
    //                 }

    //             } else {
    //                 $res = [
    //                     'message' => 'Invalid otp!',
    //                     'success' => false
    //                 ];
    //             }
    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }


    // public function checkPhone(Request $request)
    //     {   

    //          $validator = Validator::make($request->all(), [
    //         'phone_no'=>'required',
    //             ]);

    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }
    //         try {
    //                 if(User::where('phone',$request->phone_no)->exists()){
    //                     $data=User::where('phone',$request->phone_no)->get();
    //                       $res = [
    //                           'data'=>$data,
    //                     'type'=>'login',
    //                     'success' => true,
    //                 ];
    //                   }
    //                 else{
    //                      $res = [
    //                     'type'=>'Register',
    //                     'success' => true,
    //                 ];
    //                 }
    //             return response()->json($res);
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }

    // public function managerLogin(Request $request)
    //     {   
    //          $validator = Validator::make($request->all(), [
    //         'email'=>'required|exists:users,email',
    //         'password'=>'required',
    //             ]);
    //             if($validator->fails()){
    //             return response()->json([
    //             'message'=>'Validation Fails',
    //             'error'=>$validator->errors()
    //         ],422);
    //             }

    //         try {
    //              if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'role'=>'admin'])) {

    //                 $user = Auth::user();
    //                 $token = $user->createToken('Admin')->plainTextToken;
    //                 return response()->json([
    //                     'data'=> $user,
    //                     'token' => $token,
    //                     'message' => 'Login Successfully',
    //                     'status' => 200,
    //                     'error' => null
    //                 ]);
    //             } else {
    //                 return response()->json([
    //                     'token' => null,
    //                     'message' => 'Invalid email or password not match!',
    //                     'status' => 305,
    //                     'error' => 401,
    //                 ]);
    //             }
    //         } catch (Exception $ex) {
    //                   return response()->json([
    //             'message'=>'something went wrong'
    //         ],400);
    // }

    // }

    public function sendOTP(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'country_code' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'error' => $validator->messages()
            ], 200);
        }
        try {
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

            return response()->json([
                'message' => 'Otp Genarate Successfully !',
                'data' => $user,
                'status' => true,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'error' => $validator->messages()
            ], 200);
        }

        try {
            $phone = $request->phone;
            $enteredOTP = $request->otp;
            $user = Customer::where('phone', $phone)->first();
            if ($user && $user->otp === $enteredOTP) {
                if (now()->lt($user->expires_at)) {

                    $token = $user->createToken('customer')->plainTextToken;
                    return response()->json([
                        'message' => 'Login Successfully !',
                        'token' => $token,
                        'data' => $user,
                        'status' => true,
                    ]);
                }
            }
            return response()->json([
                'otp' => 'Invalid or expired OTP',
                'data' => '',
                'status' => false
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated',
                'status' => false,
                'error' => null
            ], 401);
        }
        $user->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function updateProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'error' => $validator->messages()
            ], 200);
        }

        try {

            $user = Auth::guard('sanctum')->user();
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'status' => false,
                    'error' => null
                ], 401);
            }

            if ($user->role == 'customer') {

                $customer = Customer::find($user->id)->update(
                    [
                        'dob_time' => $request->dob_time,
                        'dob' => $request->dob,
                    ]
                );
            }

            $image = Customer::find($user->id);
            $oldImagePath = public_path('images/' . $image->image);

            // if ($request->hasFile('image')) {
            //     // Delete the old image if it exists
            //     if ($image->image) {
            //         $oldImagePath = public_path('images/' . $image->image);
            //         if (File::exists($oldImagePath)) {
            //             File::delete($oldImagePath);
            //         }
            //     }
            //     $imageName = 'Img' . time() . '.' . $request->image->extension();
            //     $request->image->move(public_path('images'), $imageName);

            //     $data = Customer::find($user->id)->update([
            //         'image' => $imageName,
            //     ]);
            //     if ($user->astrologer_id != null) {
            //         Astrologer::where('id', $user->astrologer_id)->update([
            //             'image' => $imageName,
            //         ]);
            //     }
            // }

            if ($user->astrologer_id != null) {
                Astrologer::where('id', $user->astrologer_id)->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'country' => $request->country,
                    'city' => $request->city,
                ]);
            }
            $name = $request->first_name . ' ' . $request->last_name;

            $customer = Customer::find($user->id)->update(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'country' => $request->country,
                    'city' => $request->city,
                    'name' => $name,
                    'gender' => $request->gender,
                    'is_profile' => true,
                ]
            );
            if (isset($customer)) {
                $cust = Customer::find($user->id);
                return response()->json([
                    'message' => 'Data updated successfully !',
                    'data' => $cust,
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data  not update successfully !',
                    'data' => NULL,
                    'status' => false
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }

    public function signUp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'date_of_birth' => 'required',
            'date_of_time' => 'required',
            'name' => 'required',
            'place_of_birth' => 'required',
            'gender' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Fail',
                'error' => $validator->messages()
            ], 200);
        }

        try {

            $user = Auth::guard('sanctum')->user();
            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated',
                    'status' => false,
                    'error' => null
                ], 401);
            }
            $fullName = $request->name;
            $nameParts = explode(' ', $fullName, 2); // Split into 2 parts at the first space

            $first_name = $nameParts[0];
            $last_name = isset($nameParts[1]) ? $nameParts[1] : '';
            if ($user->role == 'customer') {

                $customer = Customer::find($user->id)->update(
                    [
                        'dob_time' => $request->date_of_time,
                        'dob' => $request->date_of_birth,
                        'dob_place' => $request->place_of_birth,
                        'name' => $request->name,
                        'is_profile' => true,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'gender' => $request->gender,
                    ]
                );
            }
            if (isset($customer)) {
                $cust = Customer::find($user->id);
                return response()->json([
                    'message' => 'Data updated successfully !',
                    'data' => $cust,
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data  not update successfully !',
                    'data' => NULL,
                    'status' => false
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => NULL,
                'message' => 'Server Error -' . $ex->getMessage(),
                'status' => false
            ]);
        }
    }
}
