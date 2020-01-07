<?php

use App\User;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'rahul2rkj@gmail.com')->first();

        if (!$user)
        {
            User::create([
                'name' => 'Rahul Kumar',
                'email' => 'rahul2rkj@gmail.com',
                'role'  => 'admin',
                'password' => Hash::make('Vcx@2020')
            ]);
        }
    }
}
