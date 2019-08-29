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
        $users = array(
            array(
                'first_name' => 'Fernando',
                'last_name' => 'Maio',
                'email' => 'maio.fernando@gmail.com',
                'password' => Hash::make('figured'),
                'admin' => '1',
                'active' => '1'
            )
        );

        DB::connection('mysql2')->table('users')->insert($users);
    }
}
