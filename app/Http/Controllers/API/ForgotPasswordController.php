<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    protected function sendResetLinkResponse(Request $request)
    {
        // let validate the req
        $input = $request->only('email');

        $validator = Validator::make($input, [
            'email' => "required|email|exists:users"
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        // find the user with email like it is exits or not
        $user = User::whereEmail($input['email'])->firstOrFail();

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $input['email'],
            'token' => $token,
            'created_at' => now(),
        ]);

        // send the reset password link to registered email
        $user->sendPasswordResetEmail($token, $input['email']);

        if (Password::RESET_LINK_SENT) {
            $message = "Mail send successfully";
        } else {
            $message = "Email could not be sent to this email address";
        }

        $response = ['data' => '', 'message' => $message];

        return response($response, 200);
    }
}
