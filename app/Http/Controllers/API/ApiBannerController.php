<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ApiBannerController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getBanners()
    {
        $banners = Banner::all();

        return response()->json(['code' => 1, 'message_code' => 1, 'result' => $banners]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeBanner(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $banner = Banner::create($input);
            if (isset($input['photo']) && $input['photo']) {
                $banner->addMedia($input['photo'])->toMediaCollection(Banner::IMAGE_PATH, config('app.media_disc'));
            }

            $response = ['code' => 1, 'message_code' => 1, 'result' => $banner];
            DB::commit();

            return response()->json($response, 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  new UnprocessableEntityHttpException($exception->getMessage());
        }
    }
}
