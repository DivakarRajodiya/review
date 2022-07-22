<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class ApiSettingController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getSetting()
    {
        $companyURL = Setting::where('key', 'company_url')->first()->value;
        $email = Setting::where('key', 'email')->first()->value;
        $phone = Setting::where('key', 'phone')->first()->value;
        $address = Setting::where('key', 'address')->first()->value;
        $companyName = Setting::where('key', 'application_name')->first()->value;
        $companyLogo = Setting::where('key', 'logo')->first()->value;

        $mapData = [];
        $data = [
            'company_url' => $companyURL,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'company_name' => $companyName,
            'company_logo' => $companyLogo,
            'map_data' => $mapData,
        ];

        $response = ['status' => 1, 'setting_data' => $data, 'message' => 'Setting Retried Successfully'];

        return response()->json($response, 200);
    }
}
