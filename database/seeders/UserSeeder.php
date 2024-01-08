<?php

namespace Database\Seeders;

use App\Enums\RoleTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => RoleTypeEnum::ADMIN->value]);
        $role = Role::create(['name' => RoleTypeEnum::CLIENT->value]);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->assignRole(RoleTypeEnum::ADMIN->value);
    }
}
