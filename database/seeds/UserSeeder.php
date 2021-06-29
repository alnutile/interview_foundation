<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
          'name' => 'Anthony Ereng', 
          'email' => 'aereng@test.local',
          'password' => bcrypt('Qwerty!0'),
        ]);
    }
}
