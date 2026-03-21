<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TwoFactorCodeNotification;
use App\Notifications\TwoFactorEnabledNotification;
use App\Notifications\TwoFactorDisabledNotification;
use App\Services\TwoFactorAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    protected TwoFactorAuthService $twoFactorService;

    public function __construct(TwoFactorAuthService $twoFactorService)
    {
        // Middleware should be applied via routes
        $this->twoFactorService = $twoFactorService;
    }

    /**
     * Show the 2FA setup page.
     */
    public function showSetup()
    {
        $user = Auth::user();
        
        if ($user->two_factor_enabled) {
            return redirect()->route('profile.edit')->with('status', '2FA is already enabled.');
        }

        // Generate new secret
        $secret = $this->twoFactorService->generateSecret();
        $qrCodeUrl = $this->twoFactorService->getQRCodeUrl($user->email, $secret);

        return view('auth.two-factor.setup', [
            'secret' => $secret,
            'qrCodeUrl' => $qrCodeUrl,
        ]);
    }

    /**
     * Enable 2FA for the user.
     */
    public function enable(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
            'secret' => 'required|string',
        ]);

        /** @var User $user */
        $user = Auth::user();
        
        // Verify the OTP code
        $secret = $request->secret;
        if (!$this->twoFactorService->verifyOTP($secret, $request->code)) {
            return back()->withErrors(['code' => 'Invalid verification code.']);
        }

        // Enable 2FA
        $result = $this->twoFactorService->enableForUser($user);

        // Store the secret temporarily for backup codes display
        session([
            'two_factor_secret' => $result['secret'],
            'recovery_codes' => $result['recovery_codes']
        ]);

        // Send notification
        $user->notify(new TwoFactorEnabledNotification());

        return redirect()->route('profile.edit')
            ->with('status', 'Two-factor authentication enabled successfully!')
            ->with('recovery_codes', $result['recovery_codes']);
    }

    /**
     * Show backup codes after enabling 2FA.
     */
    public function showBackupCodes()
    {
        $secret = session('two_factor_secret', null);
        $recovery_codes = session('recovery_codes', []);

        if (!$secret) {
            return redirect()->route('profile.edit');
        }

        // Clear the session
        session()->forget(['two_factor_secret', 'recovery_codes']);

        return view('auth.two-factor.backup-codes', compact('recovery_codes'));
    }

    /**
     * Disable 2FA for the user.
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Verify password
        if (!password_verify($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $this->twoFactorService->disableForUser($user);

        // Send notification
        $user->notify(new TwoFactorDisabledNotification());

        return redirect()->route('profile.edit')
            ->with('status', 'Two-factor authentication disabled.');
    }

    /**
     * Show the 2FA verification page.
     */
    public function showVerify()
    {
        /** @var User $user */
        $user = Auth::user();

        // Send new OTP code via email
        $otp = $this->twoFactorService->sendOTPViaEmail($user);

        return view('auth.two-factor.verify');
    }

    /**
     * Verify 2FA code during login.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // First try email-based OTP verification (session-stored)
        if ($this->twoFactorService->verifyOTPFromEmail($request->code)) {
            session(['two_factor_verified' => true]);
            return redirect()->intended(route('dashboard'));
        }

        // Try TOTP-based OTP verification (authenticator app)
        $secret = $this->twoFactorService->decryptSecret($user->two_factor_secret);
        if ($this->twoFactorService->verifyOTP($secret, $request->code)) {
            session(['two_factor_verified' => true]);
            return redirect()->intended(route('dashboard'));
        }

        // Try recovery code
        if ($this->twoFactorService->verifyRecoveryCode($user, $request->code)) {
            session(['two_factor_verified' => true]);
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors(['code' => 'Invalid verification code.']);
    }

    /**
     * Show the 2FA verification page for new registrations.
     */
    public function showVerifyRegistration()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        $user = Auth::user();

        return view('auth.two-factor.verify-registration', [
            'email' => $user->email,
        ]);
    }

    /**
     * Verify the 2FA code from registration.
     */
    public function verifyRegistration(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Verify the OTP code
        if (!$this->twoFactorService->verifyOTPFromEmail($request->code)) {
            return back()->withErrors(['code' => 'Invalid or expired verification code.']);
        }

        // Mark user as email verified (2FA completed)
        $user->email_verified_at = now();
        $user->save();

        // Clear pending 2FA session
        $this->twoFactorService->clearPending2FA();

        // Enable 2FA for the user
        $result = $this->twoFactorService->enableForUser($user);

        // Store secret and recovery codes for backup codes display
        session([
            'two_factor_secret' => $result['secret'],
            'recovery_codes' => $result['recovery_codes']
        ]);

        // Send notification
        $user->notify(new TwoFactorEnabledNotification());

        return redirect()->route('dashboard')
            ->with('status', 'Email verified successfully! Two-factor authentication is now enabled.')
            ->with('recovery_codes', $result['recovery_codes']);
    }

    /**
     * Resend the verification code.
     */
    public function resendCode()
    {
        /** @var User $user */
        $user = Auth::user();

        // Send new OTP code
        $this->twoFactorService->sendOTPViaEmail($user);

        return back()->with('status', 'A new verification code has been sent to your email.');
    }

    /**
     * Regenerate backup codes.
     */
    public function regenerateBackupCodes(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Verify password
        if (!password_verify($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        $recoveryCodes = $this->twoFactorService->generateRecoveryCodes();
        
        $user->two_factor_recovery_codes = json_encode($recoveryCodes);
        $user->save();

        return redirect()->route('profile.edit')
            ->with('status', 'Backup codes regenerated successfully!')
            ->with('recovery_codes', $recoveryCodes);
    }
}
