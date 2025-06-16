<?php

namespace Database\Seeders;

use App\Models\GeneralPassword;
use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = SuperAdmin::Create(
[
                'email' => env('SUPER_ADMIN_ACCOUNT'),
                'name' => env('SUPER_ADMIN_NAME'),
                'password' => Hash::make(env('SUPER_ADMIN_PASSWORD')),
            ]
        );

        GeneralPassword::updateOrCreate(
[
                'accessible_type' => get_class($superAdmin), // أو 'App\Models\SuperAdmin'
                'accessible_id' => $superAdmin->id,
            ],
    [
                'general_code' => env('SUPER_ADMIN_GENERAL_PASSWORD'),
            ]
        );
    }
}
