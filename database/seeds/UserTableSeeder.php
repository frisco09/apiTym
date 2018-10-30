<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::flushEventListeners();
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@example.com';
        $user->user_psp = 'userPsp';
        $user->phone = '0203456';
        $user->status = "no disponible";
        $user->credito = '0';
        $user->verified = '0';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@example.com';
        $user->user_psp = 'userPsp1';
        $user->phone = '02034560';
        $user->status = "no disponible";
        $user->credito = '0';
        $user->verified = '0';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);
     }
}
