<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;
use App\Business;

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

        Business::create([
            'id' => 1,
            'name' => 'LuxMeUp',
            'district_id' => '5781', //depok, sleman, yogya
            'phone_number' => '08121273819',
            'email' => 'luxmeup@gmail.com'
        ]);

        User::create([
            'username' => 'adminkalola',
            'password' => 'asdasd',
            'name' => 'Admin Kalola',
            'role_id' => 1,
        ]);

        User::create([
            'username' => 'owner1',
            'password' => 'asdasd',
            'name' => 'Owner UMKM A',
            'role_id' => 2,
            'business_id' => 1,
        ]);

        User::create([
            'username' => 'employee1',
            'password' => 'asdasd',
            'name' => 'Employee UMKM A',
            'role_id' => 3,
            'business_id' => 1,
        ]);
    }
}
