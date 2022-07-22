<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ApiLoginUserController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
//                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|min:6',
                'phone' => 'required|unique:users',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 0, 'error_message' => $validator->errors()->first()], 422);
            }
            $input['password'] = Hash::make($input['password']);
            $input['user_type'] = User::USER;
            $input['email_verified_at'] = Carbon::now();
            if (isset($input['fcm_token']) && !is_null($input['fcm_token'])) {
                $input['fcm_token'] = isset($input['fcm_token']) ? $input['fcm_token'] : null;
            }
            $user = User::create($input);
            $accessToken = $user->createToken('authToken')->accessToken;
            $user->update(['token' => $accessToken]);
            $user->server_token = $user->token;
            if (isset($input['photo']) && $input['photo']) {
                $user->addMedia($input['photo'])->toMediaCollection(User::IMAGE_PATH, config('app.media_disc'));
            }
            $user = User::where('id', $user->id)->select('id', 'name', 'email', 'email_verified_at', 'password', 'user_type', 'phone', 'gender', 'address', 'token as server_token', 'fcm_token')->first();
            $response = ['status' => 1, 'user_data' => $user, 'message' => 'Register Successfully'];

            DB::commit();

            return response()->json($response, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     *
     * @return Application|ResponseFactory|Response
     */
    public function login(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => 'string|email|max:255',
            'password' => 'min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error_message' => $validator->errors()->first()], 422);
        }
        if (isset($input['email'])) {
            $user = User::where('email', $input['email'])->where('user_type', $input['user_type'])->first();
        } else {
            $user = User::where('phone', $input['phone'])->where('user_type', $input['user_type'])->first();
        }
        if ($user) {
            if (Hash::check($input['password'], $user->password)) {
                $accessToken = $user->createToken('authToken')->accessToken;
                $user->update([
                    'token' => $accessToken,
                ]);
                if (isset($input['fcm_token']) && !is_null($input['fcm_token'])) {
                    $user->update([
                        'fcm_token' => isset($input['fcm_token']) ? $input['fcm_token'] : null,
                    ]);
                }
                $user = User::where('id', $user->id)->select('id', 'name', 'email', 'email_verified_at', 'password', 'user_type', 'phone', 'gender', 'address', 'token as server_token', 'fcm_token')->first();

                $response = ['status' => 1, 'user_data' => $user, 'message' => 'Login Successfully'];

                return response()->json($response, 200);
            } else {
                $response = ['status' => 0, 'error_message' => 'Password mismatch'];

                return response()->json($response, 422);
            }
        } else {
            $response = ['status' => 0, 'error_message' => 'User does not exist'];

            return response()->json($response, 422);
        }
    }

    /**
     * @param Request $request
     *
     * @return Application|ResponseFactory|Response
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['status' => 1, 'message' => 'You have been successfully logged out!'];

        return response()->json($response, 200);
    }
}
