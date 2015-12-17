<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\LaravelRestCms\User\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(['first_name' => 'Admin', 'last_name' => 'User', 'email' => 'admin@some-domain.com', 'username' => 'admin', 'password' => '123']);
    }

}