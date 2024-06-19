<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'user_type' => 'admin',
            'password' => bcrypt('admin123'),
        ]);
        $role = Role::find(1);
        $user->assignRole($role->name);
    }
}
