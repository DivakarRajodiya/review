<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logo = asset('img/main_logo.jpeg');

        Setting::create(['key' => 'application_name', 'value' => 'Laravel']);
        Setting::create(['key' => 'company_url', 'value' => 'laravel.com']);
        Setting::create(['key' => 'email', 'value' => 'laravel@gmail.com']);
        Setting::create(['key' => 'phone', 'value' => '1234567890']);
        Setting::create(['key' => 'address', 'value' => 'Gujarat, India']);
        Setting::create(['key' => 'logo', 'value' => $logo]);
        Setting::create(['key' => 'firebase_key', 'value' => null]);
    }
}
