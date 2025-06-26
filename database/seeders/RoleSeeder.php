<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create roles
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $moderatorRole = Role::firstOrCreate(['name' => 'moderator']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminUser = User::find(1);

        if ($adminUser) {
            $adminUser->roles()->attach($adminRole);
        }

        $users = User::where('id', '!=', 1)->get();

        foreach ($users as $user) {
            $user->roles()->attach($userRole);
        }
    }
}
