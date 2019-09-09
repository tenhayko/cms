<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
	        'name' => str_random(5).' '.str_random(5) ,
	        'job_title' => '',
	        'status' => 1,
	        'email' =>'tenhayko@gmail.com',
	        'password' => bcrypt('123456'),
	    ]);
    }
}
