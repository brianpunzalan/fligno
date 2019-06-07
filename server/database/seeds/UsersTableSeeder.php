<?php

use Fligno\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->truncate();

        // initial Admin user
        DB::table('users')->insert([
            'first_name' => env('INITIAL_ADMIN_FIRSTNAME', 'Mr.'),
            'last_name' => env('INITIAL_ADMIN_LASTNAME', 'Administrator'),
            'email' => env('INITIAL_ADMIN_EMAIL', 'admin@fligno.com'),
            'password' => bcrypt(env('INITIAL_ADMIN_PASSWORD', 'test123')),
            'gender' => 'Others',
            'avatar' => 'avatars/' . $faker->image(storage_path('app/public/avatars'), 400,400, 'people', false),
            'description' => 'I am the administrator',
            'api_token' => Str::random(60),
        ]);

        // Faker generator
        factory(User::class, 50)->create();
    }
}
