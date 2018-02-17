<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create([
        'name' => 'Nomendra Sinha',
        'email' => 'nomendrasinha@gmail.com',
        'password' =>Hash::make('test1245'), //'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    	]);
    	factory(App\User::class, 3)->create();
    }
}
