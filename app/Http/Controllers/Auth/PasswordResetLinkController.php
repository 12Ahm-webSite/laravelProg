<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
        ]);

        $login = $request->input('login');

        // تحديد نوع الإدخال
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($field, $login)->first();

        if (!$user) {
            return back()->withErrors(['login' => 'هذا الحساب غير موجود']);
        }

        // توليد OTP
        $otp = rand(1000, 9999);

        // حفظ الـ OTP مؤقتًا
        session([
            'otp' => $otp,
            'otp_user_id' => $user->id,
        ]);

        if ($field === 'email') {
            Mail::raw("رمز استعادة كلمة المرور الخاص بك هو: $otp", function($message) use ($user){
                $message->to($user->email)
                        ->subject('رمز استعادة كلمة المرور');
            });
        } else {
            \App\Services\SMSService::send($user->phone, "رمز استعادة كلمة المرور: $otp");
        }

        return view('auth.verify-otp');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:4',
            'otp.*' => 'required|digits:1',
        ]);

        $otp = implode('', $request->otp);

        if ($otp == session('otp') && session('otp_user_id')) {
            $user = User::find(session('otp_user_id'));

            // حذف الـ OTP بعد التحقق
            session()->forget(['otp', 'otp_user_id']);

            // توليد token صالح لنظام Laravel
            $token = Password::createToken($user);

            // إعادة توجيه المستخدم للفورم مع email و token
            return redirect()->route('password.reset', [
                'token' => $token,
                'email' => $user->email
            ]);
        }

        return back()->withErrors(['otp' => 'الكود غير صحيح']);
    }
    
        
    
}
