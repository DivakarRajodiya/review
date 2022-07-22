<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiNotificationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function get(Request $request)
    {
        $userid = auth('api')->user()->id;

        $notifications = Notification::where('user_id', $userid)->where('delete', 0)->orderBy('updated_at', 'desc')->get();
        foreach ($notifications as &$notification) {
            if ($notification->image == null) {
                $notification->image = asset('img/main_logo.jpeg');
            }
        }

        $notification = Notification::where('user_id', $userid)->first();
        $notification->update([
            'read' => 1
        ]);

        $response = [
            'error' => '0',
            'notify' => $notification,
        ];


        return response()->json($response, 200);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $userid = auth('api')->user()->id;
        $id = $request->input('id');

        $notification = Notification::where('id', $id)->where('user_id', $userid)->first();
        $notification->update([
            'delete' => 1,
        ]);

        $response = [
            'error' => '0',
        ];

        return response()->json($response, 200);
    }
}
