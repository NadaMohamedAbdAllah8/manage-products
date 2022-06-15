<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //if (DB::table('admins')->count() == 0) {
        Admin::updateOrCreate([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' =>
            '$2y$10$mb0rNw2GlNGWP66WdHpP0OELkKgVAbZQC33QqP6cctaUOtVX5fjSm', // 123 generated by bcrypt algorithm
        ]);
    }
    // }
}