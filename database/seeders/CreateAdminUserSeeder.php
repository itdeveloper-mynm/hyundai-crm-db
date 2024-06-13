<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //php artisan db:seed --class=CreateAdminUserSeeder

        $user = User::updateorCreate([
            'name' => 'Super Admin',
            'email' => 'profile@sohoby.com',
            'password' => Hash::make('098765qwerty')
        ]);

        $role = Role::updateorCreate(['name' => 'SuperAdmin']);

        //$permissions = Permission::pluck('id','id')->all();

        //$role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
