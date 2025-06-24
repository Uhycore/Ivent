 <?php
namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
   

    public function showResetForm(Request $request, $token)
    {
        try {
            $decryptedEmail = Crypt::decryptString($request->email);
        } catch (\Exception $e) {
            abort(403, 'Email tidak valid atau rusak.');
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $decryptedEmail
        ]);
    }


    public function reset(Request $request)
    {
    try {
        $email = Crypt::decryptString($request->input('email'));
    } catch (\Exception $e) {
        return back()->withErrors(['email' => 'Email tidak valid atau rusak']);
    }

    $request->merge(['email' => $email]);

    $request->validate([
        'token'    => 'required',
        'email'    => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();
        }
    );

    return $status == Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
 }

    //public function reset(Request $request)
    // {
    //     $request->validate([
    //         'token'    => 'required',
    //         'email'    => 'required|email',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password),
    //                 'remember_token' => Str::random(60),
    //             ])->save();
    //         }
    //     );

    //     return $status == Password::PASSWORD_RESET
    //         ? redirect()->route('login')->with('status', __($status))
    //         : back()->withErrors(['email' => [__($status)]]);
    // }
}
