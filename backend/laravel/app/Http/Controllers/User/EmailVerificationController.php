<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    public function verify(User $user): RedirectResponse
    {
        $user->markEmailAsVerified();

        return redirect(env('APP_URL', 'http://localhost') . '/email-verified');
    }

    public function resend(): JsonResponse
    {
        $user = Auth::user();
        $signedRoute = URL::temporarySignedRoute('verification.verify', now()->addDay(), ['hash' => sha1($user->getEmailForVerification()), 'user' => $user]);
        $user->notify(new VerifyEmailNotification($signedRoute));
//        я спиздила код с профтима если что, все претензии к ним

        return response()->json();
    }
}
