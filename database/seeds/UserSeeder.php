<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['id' => 1, 'name' => 'Administrator']);
        Role::create(['id' => 2, 'name' => 'Owner']);
        Role::create(['id' => 3, 'name' => 'Employee']);

        User::create([
            'username' => 'adminkalola',
            'password' => 'asdasd',
            'name' => 'Admin Kalola',
            'role_id' => 1
        ]);

        User::create([
            'username' => 'owner1',
            'password' => 'asdasd',
            'name' => 'Owner UMKM A',
            'role_id' => 2
        ]);

        User::create([
            'username' => 'employee1',
            'password' => 'asdasd',
            'name' => 'Employee UMKM A',
            'role_id' => 3
        ]);
    }
}
