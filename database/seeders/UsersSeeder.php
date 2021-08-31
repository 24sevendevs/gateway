<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Admin",
                "email" => "info@24seven.co.ke",
                "password" => '$2y$10$zTXXPK4YInbk9uK74FFbrOVfB1U9AcWzbZIL2LUdPUSaDMdNAaZFi',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
