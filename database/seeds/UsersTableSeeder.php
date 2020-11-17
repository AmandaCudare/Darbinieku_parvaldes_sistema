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
        DB::table('users')->insert([
            ['First_name' => 'admin',
            'Last_name' => 'admin',
            'email' => 'admin@info.lv',
            'password' => bcrypt('admin12345'),
            'Active' => 1,
            'Role' => 1,
            'Workload' => 1.0,
        ],[
            'First_name' => 'vad',
            'Last_name' => 'pirmais',
            'email' => 'vad@dps.lv',
            'password' => bcrypt('vad12345'),
            'Active' => 1,
            'Role' => 3,
            'Workload' => 1.0,
        ],[
            'First_name' => 'darb',
            'Last_name' => 'pirmais',
            'email' => 'darb@dps.lv',
            'password' => bcrypt('darb12345'),
            'Active' => 1,
            'Role' => 2,
            'Workload' => 1.0,]
        ]);
    }
}
