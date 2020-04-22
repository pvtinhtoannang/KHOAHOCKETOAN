<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Date();
        $date = $date::now();
        DB::table('permissions')->insert([
            'name' => 'add_post',
            'display_name' => 'Thêm mới bài viết',
            'created_at' => $date,
            'updated_at' => $date
        ]);
        DB::table('permissions')->insert([
            'name' => 'edit_post',
            'display_name' => 'Chỉnh sửa bài viết',
            'created_at' => $date,
            'updated_at' => $date
        ]);


        DB::table('permissions')->insert([
            'name' => 'delete_post',
            'display_name' => 'Xoá bài viết',
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('permissions')->insert([
            'name' => 'add_page',
            'display_name' => 'Thêm trang',
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit_page',
            'display_name' => 'Chỉnh sửa trang',
            'created_at' => $date,
            'updated_at' => $date
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete_page',
            'display_name' => 'Xoá trang',
            'created_at' => $date,
            'updated_at' => $date
        ]);


    }
}
