<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    public function emailLink(Request $request, MailerService $mailer): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), ResetPasswordRequest::emailLink());

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::whereEmail($request->input('email'))->first();
            //TODO: set route() helpers in places, where using href and remote links.
            $mailer->sendPasswordResetMail($user);

            return response()->json([
                'status' => true,
                'message' => "Email with link for resetting password was sended to {$request->email}."
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage(), 'errors' => $e->errors()]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Send reset password link to phone number via sms.
     *
     * @param Request $request
     * @param SmsService $sms
     * @return JsonResponse
     * @throws Exception
     */
    public function smsLink(Request $request, SmsService $sms): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), ResetPasswordRequest::smsLink());

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::wherePhoneNumber($request->input('phone_number'))->first();

            $sms->sendSimpleSMS($request->input('phone_number'), $user->generatePasswordResetURL());

            return response()->json([
                'status' => true,
                'message' => "Activation code for resetting password was sended to phone number {$request->phone_number}."
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage(), 'errors' => $e->errors()]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Save new password.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function setNewPassword(Request $request, MailerService $mailer): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), ResetPasswordRequest::setNewPassword());

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::where('reset_password_token', $request->input('token'))->first();
            /** Remove reset password token and set new password */
            $user->reset_password_token = null;
            $user->password = $request->input('new_password');
            $user->save();

            /**Send notification to user, what changed password */
            // $user->notify(new ResetPassword());
            $mailer->sendNotifyChangePassword($user);
            //TODO: set route() helpers in places, where using href and remote links.

            return response()->json(['status' => true, 'message' => "Password changed successfully."]);
        } catch (ValidationException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage(), 'errors' => $e->errors()]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getImage($name)
    {
        return response()->file(base_path() . '/resources/img/' . $name . '.png');
    }

    public function reset() {


    }
    /**
     *
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
