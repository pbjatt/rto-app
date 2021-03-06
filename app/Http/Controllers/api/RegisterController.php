<?php

namespace App\Http\Controllers\api;

use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use App\Models\Signature;
use Mail;

class RegisterController extends Controller
{
    public function checkusername(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'     => 'required',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user = User::where('user_name', $request->user_name)->first();
            if (!empty($user->id)) {
                $re = [
                    'status'    => false,
                    'message'   => 'The user name has already been taken.',
                ];
            } else {
                $re = [
                    'status'    => true,
                    'message'   => 'The user name has available.',
                ];
            }
        }
        return response()->json($re);
    }

    protected function referalcode($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|regex:/[A-Za-z ]+/',
            'user_name'      => 'required|unique:users',
            'mobile'        => 'required|string|regex:/\d{10}/|unique:users',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|string|same:password|min:6',
            'termcondition' => 'required',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user  =  new User;
            $dataArr = [
                'name'          => request('name'),
                'user_name'     => request('user_name'),
                'mobile'        => request('mobile'),
                'email'         => request('email'),
                'password'      => Hash::make(request('password')),
                'device_type'   => request('device_type'),
                'device_id'     => request('device_id'),
                'fcm_id'        => request('fcm_id'),
                'termcondition' => request('termcondition'),
                'accept_code'   => request('accept_code'),
                'role_id'       => '2'
            ];
            $name = str_replace(' ', '', $request->name);
            $name = ucwords(strtoupper($name));
            $name = substr($name, 0, 4);
            $referal_code = trim($name . '' . $this->referalcode());

            $setting = Setting::find(1);

            $user->fill($dataArr);
            $user->referal_code = $referal_code;

            if ($request->accept_code != '') {
                $checkCode = User::where('referal_code', $request->accept_code)->get();

                if (count($checkCode) == 1) {

                    //Generate Otp
                    $otp        = rand(100000, 999999);
                    // Send SMS
                    // $msg    = urlencode("Your one time password in ".$setting->site_title." is ".$otp." ");
                    // $apiUrl = str_replace(["[message]", "[number]"], [$msg, request('mobile')], $setting->sms_api);
                    // $sms    = file_get_contents($apiUrl);
                    Mail::send('emails.sendotp', ['otp' => $otp, 'setting' => $setting], function ($message) use ($request, $setting) {
                        $message->to($request->email);
                        $message->subject('One Time Password For Email Verification.');
                        $message->from(env('MAIL_USERNAME'), $setting->title);
                    });

                    $user->accept_code = $request->accept_code;
                    $user->otp = $otp;
                    $user->save();

                    //add signnature
                    $signnature = new Signature();
                    $signnature->user_id = $user->id;
                    $signnature->name = $user->name;
                    $signnature->email = $user->email;
                    $signnature->mobile = $user->mobile;
                    $signnature->save();

                    $re = [
                        'status'        => true,
                        'message'       => 'Success!! Registration successful.',
                        'user'          => $user,
                        'signnature'    => $signnature,
                    ];
                } else {
                    $re = [
                        'status'    => false,
                        'message'   => 'Error!! Referal code not valid.',
                    ];
                }
            } else {
                //Generate Otp
                $otp        = rand(100000, 999999);
                // Send SMS
                // $msg    = urlencode("Your one time password in ".$setting->site_title." is ".$otp." ");
                // $apiUrl = str_replace(["[message]", "[number]"], [$msg, request('mobile')], $setting->sms_api);
                // $sms    = file_get_contents($apiUrl);
                Mail::send('emails.sendotp', ['otp' => $otp, 'setting' => $setting], function ($message) use ($request, $setting) {
                    $message->to($request->email);
                    $message->subject('One Time Password For Email Verification.');
                    $message->from(env('MAIL_USERNAME'), $setting->title);
                });

                $user->otp = $otp;
                $user->save();

                //add signnature
                $signnature = new Signature();
                $signnature->user_id = $user->id;
                $signnature->name = $user->name;
                $signnature->email = $user->email;
                $signnature->mobile = $user->mobile;
                $signnature->save();

                $re = [
                    'status'        => true,
                    'message'       => 'Success!! Registration successful.',
                    'user'          => $user,
                    'signnature'    => $signnature,
                ];
            }
        }
        return response()->json($re);
    }

    public function verifyotp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile'    => 'required|numeric|regex:/\d{10}/',
            'otp'       => 'required'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user =  User::where('mobile', $request->mobile)->first();
            if ($user->otp == request('otp')) {
                $user->otp_verified   = 'true';
                $user->save();

                $re = [
                    'status'    => true,
                    'message'   => 'Success!! Otp verified successfully.',
                    'data'      => $user
                ];
            } else {
                $re = [
                    'status'    => false,
                    'message'   => 'Error!! OTP not match.'
                ];
            }
        }
        return response()->json($re);
    }

    public function verifymail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'otp'       => 'required'
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user =  User::where('email', $request->email)->first();
            if ($user->otp == request('otp')) {
                $user->email_verified   = 'true';
                $user->save();

                $re = [
                    'status'    => true,
                    'message'   => 'Success!! Email verified successfully.',
                    'data'      => $user
                ];
            } else {
                $re = [
                    'status'    => false,
                    'message'   => 'Error!! OTP not match.'
                ];
            }
        }
        return response()->json($re);
    }

    public function sendotp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile'     => 'required|numeric|regex:/\d{10}/',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user = User::where('mobile', $request->mobile)->first();
            if (!empty($user->id)) {
                //Generate Otp
                $otp        = rand(100000, 999999);
                // Send SMS
                // $msg    = urlencode("Your one time password in ".$setting->site_title." is ".$otp." ");
                // $apiUrl = str_replace(["[message]", "[number]"], [$msg, request('mobile')], $setting->sms_api);
                // $sms    = file_get_contents($apiUrl);
                $user->otp = $otp;
                $user->save();

                $re = [
                    'status'    => true,
                    'message'   => 'Otp has been sent to ' . request('mobile'),
                    'data'      => $otp
                ];
            } else {
                $re = [
                    'status'    => false,
                    'message'   => 'Mobile number not exits.',
                ];
            }
        }
        return response()->json($re);
    }

    public function sendotpmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|email',
        ]);
        if ($validator->fails()) {
            $re = [
                'status'    => false,
                'message'   => 'Validations errors found.',
                'errors'    => $validator->errors()
            ];
        } else {
            $user = User::where('email', $request->email)->first();
            if (!empty($user->id)) {

                $setting = Setting::find(1);

                //Generate Otp
                $otp        = rand(100000, 999999);
                // Send SMS

                Mail::send('emails.sendotp', ['otp' => $otp, 'setting' => $setting], function ($message) use ($request, $setting) {
                    $message->to($request->email);
                    $message->subject('One Time Password For Email Verification.');
                    $message->from(env('MAIL_USERNAME'), $setting->title);
                });

                $user->otp = $otp;
                $user->save();

                $re = [
                    'status'    => true,
                    'message'   => 'Otp has been sent to ' . request('email'),
                    'data'      => $otp
                ];
            } else {
                $re = [
                    'status'    => false,
                    'message'   => 'Email not exits.',
                ];
            }
        }
        return response()->json($re);
    }
}
