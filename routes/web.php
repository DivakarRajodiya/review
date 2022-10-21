<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ReviewController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('config:cache');
    Artisan::call('storage:link');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');

    return Artisan::output();
});

Route::get('/run-migration', function () {
    Artisan::call('migrate --path=database/migrations/2014_10_12_000000_create_users_table.php');
    Artisan::call('migrate --path=database/migrations/2014_10_12_100000_create_password_resets_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000001_create_oauth_auth_codes_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000002_create_oauth_access_tokens_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000003_create_oauth_refresh_tokens_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000004_create_oauth_clients_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000005_create_oauth_personal_access_clients_table.php');
    Artisan::call('migrate --path=database/migrations/2019_08_19_000000_create_failed_jobs_table.php');
    Artisan::call('migrate --path=database/migrations/2021_10_05_182535_create_media_table.php');
    Artisan::call('migrate --path=database/migrations/2021_10_08_184648_create_settings_table.php');
    Artisan::call('migrate --path=database/migrations/2021_10_16_120954_create_notifications_table.php');
    Artisan::call('migrate --path=database/migrations/2022_07_19_191210_create_banners_table.php');

    Artisan::call('db:seed --class=DatabaseSeeder');

    return Artisan::output();
});

Route::get('/token-migration', function () {
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000001_create_oauth_auth_codes_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000002_create_oauth_access_tokens_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000003_create_oauth_refresh_tokens_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000004_create_oauth_clients_table.php');
    Artisan::call('migrate --path=vendor/laravel/passport/database/migrations/2016_06_01_000005_create_oauth_personal_access_clients_table.php');

    return Artisan::output();
});

Route::get('/user-migration-in-change', function () {
    Artisan::call('migrate --path=database/migrations/2021_10_14_192720_add_firebase_token_in_users_table.php');
});

Route::get('/notification-migration', function () {
    Artisan::call('migrate --path=database/migrations/2021_10_16_120954_create_notifications_table.php');
    Setting::create(['key' => 'firebase_key', 'value' => null]);

    return Artisan::output();
});

Route::get('/contact-us-migration', function () {
    Artisan::call('migrate --path=database/migrations/2022_10_18_194908_create_contact_us_table.php');

    return Artisan::output();
});

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Users
Route::resource('users', UserController::class);
Route::post('update-profile/{user}', [UserController::class, 'updateProfile'])->name('update.profile');
Route::post('update-password', [UserController::class, 'updatePassword'])->name('update.user-password');
Route::post('change-is-active', [UserController::class, 'changeIsActive'])->name('update.is-active');

// Banners
Route::resource('banners', BannerController::class)->except(['update', 'edit', 'destroy']);
Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
Route::put('banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
Route::delete('banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');

// Setting
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

// Review
Route::resource('reviews', ReviewController::class)->except(['update', 'edit', 'destroy']);
Route::post('reviews/{user}/send-notification', [ReviewController::class, 'sendNotification'])->name('reviews.send-notification');
Route::delete('reviews/{user}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Contact us
Route::resource('contact-us', ContactUsController::class)->except(['update', 'edit', 'destroy']);
Route::delete('contact-us/{contactUs}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');

Auth::routes();
