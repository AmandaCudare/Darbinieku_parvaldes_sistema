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
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'First_name' => 'administrators',
            'Last_name' => 'administrators',
            'email' => 'admin@info.lv',
            'password' => bcrypt('admin12345'),
            'Active' => 1,
            'Role' => 1,
            'Workload' => 1.0,
        ]);
    }
}
