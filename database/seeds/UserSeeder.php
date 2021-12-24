<?php

use Illuminate\Database\Seeder;
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
        User::create([
            'name' => 'superadmin',
            'email' => 'ro@xisensoft.com',
            'address_1' => 'Address 1',
            'address_2' => 'Address 2',
            'address_3' => 'Address 3',
            'address_4' => 'Address 4',
            'address_5' => 'Address 5',
            'password' => bcrypt('admin1234'),
            'role' => 1
        ]);
    }
}
