<?php

use Fligno\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        // initial Admin user
        DB::table('users')->insert([
            'first_name' => env('INITIAL_ADMIN_FIRSTNAME', 'Mr.'),
            'last_name' => env('INITIAL_ADMIN_LASTNAME', 'Administrator'),
            'email' => env('INITIAL_ADMIN_EMAIL', 'admin@fligno.com'),
            'password' => bcrypt(env('INITIAL_ADMIN_PASSWORD', 'test123')),
        ]);

        // Faker generator
        factory(User::class, 50)->create();
    }
}
