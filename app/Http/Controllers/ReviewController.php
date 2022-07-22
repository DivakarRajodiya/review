<?php

namespace App\Http\Controllers;

use App\DataTables\ReviewTables;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;

class ReviewController extends AppBaseController
{
    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of((new ReviewTables())->get())->make(true);
        }

        return view('reviews.index');
    }

    public function sendNotification(Request $request)
    {
        $input = $request->all();
        dd($input);
        $user = User::find($input['id']);

        //
        // Send Notifications to User
        //
        if ($user){
            $myRequest = new Request();
            $myRequest->setMethod('POST');
            $myRequest->request->add(['user_id' => $user->id]);
            $myRequest->request->add(['title' => 'Review']);
            $myRequest->request->add(['text' => $input['message']]);
            $settingImage = Setting::where('key', 'logo')->first();
            if ($settingImage) {
                $myRequest->request->add(['image' => $settingImage->value]);
            }
            /** @var MessagingController $notification */
            $notification = App::make(MessagingController::class);
            $notification->sendNotify($myRequest);
        }

        $this->sendSuccess('Notification sent successfully.');

        return true;
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->update([
            'rating' => null,
            'review_message' => null,
        ]);

        return $this->sendSuccess('Review deleted successfully.');
    }
}
