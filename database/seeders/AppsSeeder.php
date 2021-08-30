<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apps = [
            "name" => "Writers Admin Employers",
            "code" => "we",
            "description" => "Writers Admin employers app has the 'e' representing 'employers'. End point is http://employer.writersadmin.com/api/payments/handle-c2b-gateway-result.",
        ];
    }
}
