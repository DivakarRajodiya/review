<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ApiReviewController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function getReview()
    {
        $users = User::where('rating', '!=', null)->where('review_message', '!=', null)->get();

        return response()->json(['code' => 1, 'message_code' => 1, 'result' => $users]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeReview(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $user = User::where('user_id', $input['user_id'])->first();
            if (!$user) {

                $user = User::create([
                    'user_id' => $input['user_id'],
                    'review_message' => $input['review_message'],
                    'rating' => $input['rating'],
                    'fcm_token' => $input['fcm_token'],
                    'user_token' => $input['user_token'],
                    'install_app' => $input['install_app'] ?? null,
                ]);

            } else {
                $user->update([
                    'review_message' => $input['review_message'],
                    'rating' => $input['rating'],
                    'fcm_token' => $input['fcm_token'],
                    'user_token' => $input['user_token'],
                    'install_app' => $input['install_app'] ?? null,
                ]);

            }

            $response = ['code' => 1, 'message_code' => 1];
            DB::commit();

            return response()->json($response, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  new UnprocessableEntityHttpException($exception->getMessage());
        }
    }
}
