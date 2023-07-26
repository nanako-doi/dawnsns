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
        //
        DB::table('users')->insert([
            ['username' => 'aaa','mail' => 'aaa@com','password' => 'aaa'],
            ['username' => 'bbb','mail' => 'bbb@com','password' => 'bbb']
        ]);
    }
}
