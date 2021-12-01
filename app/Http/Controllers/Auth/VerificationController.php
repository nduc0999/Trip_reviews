<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function viewResend()
    {

        return view('mail.web.resend-email');
    }

    public function viewVerifySuccess()
    {
        return view('mail.web.verify-success');
    }

    public function verifyEmail($hash)
    {
        $user = User::where(['verification_code' => $hash])->first();
        if($user != null){
            if ($user->email_verified_at == null) {
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $date = date('Y-m-d H:i:s');
                $user->email_verified_at = $date;
                $user->save();
                return redirect()->route('verify.success');
            } else {
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('home');
        }
    }

    public function resendEmail()
    {
        if (Auth::user() != null) {
            $name = Auth::user()->first_name." ".Auth::user()->last_name;
            $email = Auth::user()->email;
            $verification_code = Auth::user()->verification_code;
            MailController::sendRegisterEmail($name, $email, $verification_code);
            return redirect()->route('resend.page')->with(session()->flash('alert', 'Đã gửi lại email. Vui lòng kiểm tra lại email '));
        }
        return redirect()->route('resend.page')->with(session()->flash('alert', 'Something went wrong!!'));
    }
}
