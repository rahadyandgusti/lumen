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
        \DB::table('users')->insert([
            [
                'name' => 'Rahadyan D Gusti',
                'email' => 'rahadyan.d.gusti@gmail.com',
                'username' => 'rdg',
                'phone' => '098765456789',
                'password' => bcrypt('rahadyan')
            ],
        	[
        		'name' => 'Testing 1',
        		'email' => 'testing@gmail.com',
        		'username' => 'test',
        		'phone' => '098765456789',
        		'password' => bcrypt('rahadyan')
        	]
        ]);
    }
}
