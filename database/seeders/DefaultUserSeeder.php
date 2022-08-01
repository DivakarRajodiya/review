<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
        ];

        User::create($input);
    }
}
