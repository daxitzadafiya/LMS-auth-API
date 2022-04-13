<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    protected function resetPassword(ResetPasswordRequest $request)
    {
            $input = $request->validated();

            $updatePassword = DB::table('password_resets')
                ->where([
                    'email' => $input['email'],
                    'token' => $input['token']
                ])->first();

            if (!$updatePassword) {
                return back()->with([
                    'message' => 'Tokens do not match',
                ]);
            }

            $user = User::whereEmail($input['email'])
                ->update(['password' => Hash::make($input['password'])]);

            DB::table('password_resets')->whereEmail($input['email'])->delete();

            if (Password::PASSWORD_RESET) {
                $message = "Password reset successfully";
            } else {
                $message = "Email could not be sent to this email address";
            }
            $response = ['data' => '', 'message' => $message];
            
            return response()->json($response);
    }
}
