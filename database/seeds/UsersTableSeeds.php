<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = Role::where('name', 'administrator')->first();
        $employee = new User();
        $employee->name = 'Văn Tính';
        $employee->email = 'pvtinh.toannang@gmail.com';
        $employee->password = bcrypt('123456789');
        $employee->save();
        $employee->roles()->attach($administrator);


        $employee = new User();
        $employee->name = 'Minh Nhựt';
        $employee->email = 'minhnhut.toannang@gmail.com';
        $employee->password = bcrypt('123456789');
        $employee->save();
        $employee->roles()->attach($administrator);

    }
}
