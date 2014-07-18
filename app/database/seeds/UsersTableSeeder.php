<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			$user = User::create([
        'email' => $faker->email,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'username' => 'user' . $index,
        'password' => 'password',
        'password_confirmation' => 'password'
			]);
//      print_r($user->errors());
		}
	}

}
