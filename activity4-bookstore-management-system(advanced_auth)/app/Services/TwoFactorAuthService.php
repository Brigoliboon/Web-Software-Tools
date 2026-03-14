<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TwoFactorAuthService
{
    /**
     * Generate a new OTP secret for the user.
     */
    public function generateSecret(): string
    {
        return Str::random(32);
    }

    /**
     * Generate a 6-digit OTP based on the secret.
     */
    public function generateOTP(string $secret): string
    {
        // Simple time-based OTP implementation
        // In production, use a proper TOTP library like pragmarx/google2fa
        $time = floor(time() / 30);
        $hash = hash_hmac('sha1', $time, $secret);
        
        // Take first 6 characters of hex hash and convert to integer
        $offset = hexdec(substr($hash, -1)) & 0x0F;
        $binary = hexdec(substr($hash, $offset * 2, 8));
        
        // Ensure positive number
        $binary = $binary & 0x7FFFFFFF;
        
        $otp = $binary % 1000000;
        
        // Pad with leading zeros
        return str_pad((string) $otp, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Send OTP code via email to the user.
     */
    public function sendOTPViaEmail(User $user): string
    {
        // Generate a new secret if not exists, or use existing
        if (!$user->two_factor_secret) {
            $secret = $this->generateSecret();
            $user->two_factor_secret = $this->encryptSecret($secret);
            $user->save();
        }
        
        $secret = $this->decryptSecret($user->two_factor_secret);
        $otp = $this->generateOTP($secret);
        
        // Store OTP in session for verification
        session(['pending_2fa_user_id' => $user->id]);
        session(['pending_2fa_otp' => $otp]);
        session(['pending_2fa_expires' => now()->addMinutes(5)->timestamp]);
        
        // Log the OTP for development purposes (since mail driver is 'log')
        Log::info('2FA OTP for user ' . $user->email . ': ' . $otp);
        
        // Send OTP via email
        $user->notify(new TwoFactorCodeNotification($otp));
        
        return $otp;
    }

    /**
     * Verify the OTP code from email.
     */
    public function verifyOTPFromEmail(string $code): bool
    {
        $storedOtp = session('pending_2fa_otp');
        $expires = session('pending_2fa_expires');
        
        if (!$storedOtp || !$expires) {
            return false;
        }
        
        // Check if OTP has expired (5 minutes)
        if (now()->timestamp > $expires) {
            session()->forget(['pending_2fa_otp', 'pending_2fa_expires', 'pending_2fa_user_id']);
            return false;
        }
        
        return hash_equals($storedOtp, $code);
    }

    /**
     * Clear pending 2FA session data.
     */
    public function clearPending2FA(): void
    {
        session()->forget(['pending_2fa_otp', 'pending_2fa_expires', 'pending_2fa_user_id']);
    }

    /**
     * Verify the OTP code.
     */
    public function verifyOTP(string $secret, string $code): bool
    {
        // Allow for 30-second time window (current + previous + next)
        for ($i = -1; $i <= 1; $i++) {
            $time = floor(time() / 30) + $i;
            $hash = hash_hmac('sha1', $time, $secret);
            
            $offset = hexdec(substr($hash, -1)) & 0x0F;
            $binary = hexdec(substr($hash, $offset * 2, 8));
            $binary = $binary & 0x7FFFFFFF;
            
            $otp = $binary % 1000000;
            $otp = str_pad((string) $otp, 6, '0', STR_PAD_LEFT);
            
            if (hash_equals($otp, $code)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Generate recovery codes for 2FA.
     */
    public function generateRecoveryCodes(int $count = 8): array
    {
        $codes = [];
        for ($i = 0; $i < $count; $i++) {
            $codes[] = strtoupper(Str::random(8));
        }
        
        return $codes;
    }

    /**
     * Encrypt the 2FA secret for storage.
     */
    public function encryptSecret(string $secret): string
    {
        return Crypt::encryptString($secret);
    }

    /**
     * Decrypt the 2FA secret.
     */
    public function decryptSecret(string $encryptedSecret): string
    {
        return Crypt::decryptString($encryptedSecret);
    }

    /**
     * Enable 2FA for a user.
     */
    public function enableForUser($user): array
    {
        $secret = $this->generateSecret();
        $recoveryCodes = $this->generateRecoveryCodes();
        
        $user->two_factor_secret = $this->encryptSecret($secret);
        $user->two_factor_recovery_codes = json_encode($recoveryCodes);
        $user->two_factor_enabled = true;
        $user->two_factor_enabled_at = now();
        $user->save();
        
        return [
            'secret' => $secret,
            'recovery_codes' => $recoveryCodes,
        ];
    }

    /**
     * Disable 2FA for a user.
     */
    public function disableForUser($user): void
    {
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_enabled = false;
        $user->two_factor_enabled_at = null;
        $user->save();
    }

    /**
     * Verify using a recovery code.
     */
    public function verifyRecoveryCode($user, string $code): bool
    {
        $codes = json_decode($user->two_factor_recovery_codes, true) ?? [];
        
        $code = strtoupper($code);
        
        foreach ($codes as $index => $storedCode) {
            if (hash_equals($storedCode, $code)) {
                // Remove the used code
                unset($codes[$index]);
                $user->two_factor_recovery_codes = json_encode(array_values($codes));
                $user->save();
                
                return true;
            }
        }
        
        return false;
    }

    /**
     * Get the QR code URL for authenticator apps.
     */
    public function getQRCodeUrl(string $email, string $secret, string $issuer = 'PageTurner'): string
    {
        $otpauthUrl = sprintf(
            'otpauth://totp/%s:%s?secret=%s&issuer=%s',
            urlencode($issuer),
            urlencode($email),
            $secret,
            urlencode($issuer)
        );
        
        return $otpauthUrl;
    }
}