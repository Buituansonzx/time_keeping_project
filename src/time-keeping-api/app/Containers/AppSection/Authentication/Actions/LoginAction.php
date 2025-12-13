<?php

namespace App\Containers\AppSection\Authentication\Actions;

use App\Containers\AppSection\Authentication\Mails\SendOtpMail;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\PersonalAccessTokenFactory;
use Laravel\Passport\TokenRepository;

final class LoginAction extends ParentAction
{
    public function run($data)
    {
        $user = User::where('email', $data['email'])->firstOrFail();

        // Gửi OTP nếu chưa có
        if (!isset($data['otp'])) {
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(User::EXPIRED_OTP);
            $user->save();

            Mail::to($user->email)->queue(new SendOtpMail($otp));

            return [
                'message' => 'OTP đã được gửi vào email của bạn',
            ];
        }

        // Kiểm tra OTP
        if ($user->otp !== $data['otp'] || Carbon::now()->gt($user->otp_expires_at)) {
            abort(422, 'OTP không hợp lệ hoặc đã hết hạn');
        }

        // Xoá OTP sau khi sử dụng
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        $token = $user->createToken('Token Name')->accessToken;


        return [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
