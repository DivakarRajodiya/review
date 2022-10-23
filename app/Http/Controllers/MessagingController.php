<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MessagingController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    static public function sendNotify(Request $request)
    {
        $userId = $request->input('user_id');
        $title = $request->input('title');
        $body = $request->input('text');
        $image = $request->input('image');
        $chat = $request->input('chat');
        if ($chat == null) {
            $chat = "false";
        }
        $uid = uniqid();

        $pathToFCM = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = Setting::where('key', 'firebase_key')->first()->value;
        $headers = array('Authorization:key=' . $serverKey,
            'Content-Type:application/json'
        );

//        if (!Auth::check()){
//            return Redirect::route('/');
//        }

        $user = User::where('id', '=', $userId)->first();
        $token = $user->fcm_token;

        $field = [
//            'notification' => ['body' => $body, 'title' => $title, 'click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'sound' => 'default'], //, 'image' => $imageToSend),
            'priority' => 'high',
            'sound' => 'default',
//            'data' => ['click_action' => 'SplashActivity', 'id' => '1', 'status' => 'done', 'body' => $body, 'title' => $title, 'sound' => 'default', 'chat' => $chat],
            'data' => ['id' => '1', 'status' => 'done', 'body' => $body, 'title' => $title, 'sound' => 'default', 'chat' => $chat],
            'to' => $token,
            'aps' => ['alert' => ['body' => $body, 'title' => $title], 'badge' => 1, 'sound' => 'alert.mp3'],
        ];

        //echo json_encode($field, JSON_PRETTY_PRINT);

        $payload = json_encode($field);
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $pathToFCM);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
        $result = curl_exec($curl_session);

        //echo $result;

        curl_close($curl_session);
        $result = json_decode($result);
        if ($result && $result->success && $result->success == 1) {
            if ($chat == "false") {
                // add to database
                $input = [
                    'title' => $title,
                    'text' => $body,
                    'user_id' => $userId,
                    'image' => $image,
                    'uid' => $uid,
                    'delete' => 0,
                    'show' => 1,
                    'read' => 0,
                ];
                Notification::create($input);

                return  true;
            }
        } else {
            return false;
        }
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function send(Request $request)
    {
        $userId = $request->input('user_id');
        $title = $request->input('title');
        $body = $request->input('text');
        $imageid = $request->input('imageid');
        $users = DB::table('users')->get();
        $uid = uniqid();

        $pathToFCM = 'https://fcm.googleapis.com/fcm/send';
        $serverKey = Setting::where('key', 'firebase_key')->first()->value;
        $headers = array('Authorization:key=' . $serverKey,
            'Content-Type:application/json'
        );

        if (!Auth::check())
            return Redirect::route('/');

        if ($userId != -1) {
            $user = User::where('id', $userId)->first();
            $token = $user->fcm_token;

            $field = [
                'notification' => ['body' => $body, 'title' => $title, 'click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'sound' => 'default'], //, 'image' => $imageToSend),
                'priority' => 'high',
                'sound' => 'default',
                'data' => ['click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => '1', 'status' => 'done', 'body' => $body, 'title' => $title, 'sound' => 'default'],
                'to' => $token,
            ];

            //echo json_encode($field, JSON_PRETTY_PRINT);

            $payload = json_encode($field);
            $curl_session = curl_init();
            curl_setopt($curl_session, CURLOPT_URL, $pathToFCM);
            curl_setopt($curl_session, CURLOPT_POST, true);
            curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
            $result = curl_exec($curl_session);

            //echo $result;
            curl_close($curl_session);
            if ($result) {
                // add to database
                $input = [
                    'title' => $title,
                    'text' => $body,
                    'user_id' => $userId,
                    'image' => $imageid,
                    'uid' => $uid,
                    'delete' => 0,
                    'show' => 1,
                    'read' => 0,
                ];
                Notification::create($input);
            }
            //echo 'FCM Send Error: ' . curl_error($curl_session);
        } else {
            $result = false;
            foreach ($users as &$value) {
                $token = $value->fcm_token;
                if ($token != null) {
                    $field = [
                        'notification' => ['body' => $body, 'title' => $title, 'click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'sound' => 'default'],
                        'priority' => 'high',
                        'sound' => 'default',
                        'data' => ['click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => '1', 'status' => 'done', 'body' => $body, 'title' => $title, 'sound' => 'default'],
                        'to' => $token,
                    ];

                    //echo json_encode($field, JSON_PRETTY_PRINT);

                    $payload = json_encode($field);
                    $curl_session = curl_init();
                    curl_setopt($curl_session, CURLOPT_URL, $path_to_FCM);
                    curl_setopt($curl_session, CURLOPT_POST, true);
                    curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                    curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
                    $result = curl_exec($curl_session);
                    //echo $result;
                    curl_close($curl_session);
                }
            }

            if ($result) {
                // add to database
                $show = 2;
                foreach ($users as &$value) {
                    $input = [
                        'title' => $title,
                        'text' => $body,
                        'user_id' => $value->id,
                        'image' => $imageid,
                        'uid' => $uid,
                        'delete' => 0,
                        'show' => $show,
                        'read' => 0,
                    ];
                    Notification::create($input);

                    if ($show == 2) {
                        $show = 0;
                    }
                }
            }
            //echo 'FCM Send Error: ' . curl_error($curl_session);
        }
        return MessagingController::view();
    }

    /**
     * @return Application|Factory|View
     */
    function view()
    {
        $users = User::all();
        $idata = Notification::where('show', '>', 0)->orderBy('updated_at', 'desc')->limit('30')->get();
        foreach ($idata as &$value) {
            $data = DB::table('notifications')->where('uid', '=', $value->uid)->get();
            $value->countAll = count($data);
            $data = DB::table('notifications')->where('uid', '=', $value->uid)->where('read', '=', '1')->get();
            $value->countRead = count($data);
        }

        $defaultImage = Setting::where('key', 'logo')->first()->value;
        $petani = DB::table('image_uploads')->where('id', '=', $defaultImage)->get()->first();
        if ($petani != null) {
            $petani = $petani->filename;
            $fsize = filesize("images/" . $petani);
        } else {
            $petani = "";
            $fsize = 0;
        }

        $petani2 = DB::table('image_uploads')->get();

        return view('notification.notification', ['idata' => $idata, 'users' => $users, 'texton' => "", 'text' => '',
            'defaultImage' => $petani, 'defaultImageId' => $defaultImage, 'filesize' => $fsize, 'petani' => $petani2]);
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function load(Request $request)
    {
        if (!Auth::check())
            return Redirect::route('/');

        return MessagingController::view();
    }
}
