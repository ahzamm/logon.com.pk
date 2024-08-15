<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Models\GeneralConfiguration;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = Admin::where('email', $request->email)->first();

        if ($user != null && Hash::check($request->password, $user->password)) {
            if ($user->active != 1) {
                return redirect()->back()->withInput($request->only('email', 'remember'))->withMessage('Account is deactivated by Admin');
            }
            Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $general_configuration = GeneralConfiguration::first();
                if ($general_configuration->otp_status == 0) {
                    return redirect()->intended(route('admin.dashboard'));
                }
            }

            $code = random_int(1000, 9999);
            $codeCreationTime = now();
            $request->session()->forget('code');
            $request->session()->put('code', $code);
            $request->session()->put('codeCreationTime', $codeCreationTime);
            $request->session()->put('login_credentials', ['email' => $request->email, 'password' => $request->password]);

            $this->sendMail($request->email, $code);
            Auth::guard('admin')->logout();
            return redirect()->route('admin.verify');
        }
        return redirect()->back()->withInput($request->only('email', 'remember'))->withMessage('Invalid User name or Passowrd');
    }
    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }
    public function verify()
    {
        return view('admin.auth.verify');
    }
    public function verifyPost(Request $request)
    {
        $validatedData = [
            'code' => 'required',
        ];
        $validate = Validator::make($request->all(), $validatedData);
        if ($validate->fails()) {
            return redirect()->back()->withMessage('Provide an OTP.');
        }

        $codeCreationTime = $request->session()->get('codeCreationTime');
        $currentTime = now();
        $codeExpiryTime = Carbon::parse($codeCreationTime)->addMinutes(1);
        if ($currentTime->greaterThan($codeExpiryTime)) {
            return redirect()->back()->withInput()->withMessage('OTP has expired.');
        }

        if ($request->code == $request->session()->get('code')) {
            $credentials = $request->session()->get('login_credentials');
            if ($credentials) {
                Auth::guard('admin')->attempt($credentials);
                return redirect()->intended(route('admin.dashboard'));
            }
        }
        return redirect()->back()->withInput()->withMessage('Invalid OTP.');
    }
    private function sendMail($to, $code)
    {
        $subject = 'Logon Home Admin Panel Login Request | Date: ' . date('F j, Y, g:i a');
        // Always set content-type when sending HTML email
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers .= 'From: info@logon.com.pk';
        $message = view('email.verify', ['code' => $code])->render();
        mail($to, $subject, $message, $headers);
    }
}
