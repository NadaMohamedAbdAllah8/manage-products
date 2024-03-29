<?php

namespace Database\Seeders;

use App\Models\User;
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
        //  if (DB::table('users')->count() == 0) {
        User::updateOrCreate(['id' => 1], [
            'name' => 'user',
            'email' => 'user@user.user',
            'password' => bcrypt('123'), // 123 generated by bcrypt algorithm
        ]);
        //}
    }
}
