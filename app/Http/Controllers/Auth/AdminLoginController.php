<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;
use App\Admin;
use Session;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except'=>['logout']]);
    }
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }
    public function login(Request $req)
    {
        // Validate the form data
        $this->validate($req,[
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);
        // Attempt to log the user in
        $user = Admin::where('email', $req->email)->where('status', 1)->first();
        if ($user) {
            if (\Hash::check($req->password, $user->password))
            {
                $google2fa = new Google2FA();
                if ($user->google2fa_secret =='') {
                     $user->google2fa_secret = $google2fa->generateSecretKey();
                    if ($user->save()) {
                        $google2fa_url = $google2fa->getQRCodeGoogleUrl(
                            'Cms',
                            $user->email,
                            $user->google2fa_secret
                        );
                        Session::put('emailUser', $user->email);
                        return view('auth.admin-login-qrcode',['QrUrl'=>$google2fa_url, 'email'=>$user->email]);
                    }else{
                        return redirect()->back()->withInput($req->only('email', 'remember'));
                    }
                }else{
                    $google2fa_url = $google2fa->getQRCodeGoogleUrl(
                        'Cms',
                        $user->email,
                        $user->google2fa_secret
                    );
                    Session::put('emailUser', $user->email);
                    return view('auth.admin-login-qrcode',['QrUrl'=>$google2fa_url, 'email'=>$user->email]);
                }
            }
            return redirect()->back()->withInput($req->only('email', 'remember'));
        }
        return redirect()->back()->withInput($req->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function postQrcode(Request $request)
    {
        if (Session::get('emailUser') && $request->secret && $request->email == Session::get('emailUser')) {
            $google2fa = new Google2FA();
            $secret = $request->input('secret');
            $userEmail = Session::get('emailUser');
            Session()->forget('emailUser');
            Session()->flush();
            $user = Admin::where('email', $userEmail)->first();
            if ($user) {
                $valid = $google2fa->verifyKey($user->google2fa_secret, $secret);
                if ($valid) {
                    Auth::guard('admin')->login($user);
                    return redirect()->route('admin');
                }else{
                    return redirect()->route('admin.login')->withInput(['email'=>$user->email]);
                }
            }else{
                return redirect()->route('admin.login')->withInput(['email'=>$user->email]);
            }
        }else{
            Session()->forget('emailUser');
            Session()->flush();
            return redirect()->route('admin.login');
        }
    }
}
