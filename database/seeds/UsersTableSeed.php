<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Văn Tính',
            'email' => 'pvtinh.toannang@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        DB::table('users')->insert([
            'name' => 'Minh Nhựt',
            'email' => 'minhnhut.toannang@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
    }
}
