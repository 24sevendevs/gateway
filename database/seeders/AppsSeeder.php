<?php

namespace Database\Seeders;

use App\Models\App;
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
            [
                "name" => "Writers Admin Employers",
                "code" => "we",
                // "endpoint" => "https://employer-test.writersadmin.com/api/payments/handle-c2b-gateway-result",
                // "login_endpoint" => "https://employer-test.writersadmin.com/api/bots/login",
                "endpoint" => "https://employer.writersadmin.com/api/bots/payments/handle-c2b-gateway-result",
                "login_endpoint" => "https://employer.writersadmin.com/api/bots/login",
                "username" => "writers_bot",
                "password" => "pM9CMPfrF5Z9oh7vDwjMlKqD",
                "description" => "Writers Admin employers app has the 'e' representing 'employers'. Endpoint is https://employer.writersadmin.com/api/payments/handle-c2b-gateway-result.",
            ],
            [
                "name" => "Writers Admin Writers",
                "code" => "ww",
                "endpoint" => "https://employer.writersadmin.com/api/bots/payments/handle-c2b-gateway-result",
                "login_endpoint" => "https://employer.writersadmin.com/api/bots/login",
                "username" => "writers_bot",
                "password" => "pM9CMPfrF5Z9oh7vDwjMlKqD",
                "description" => "Writers Admin writers app has the 'w' representing 'writers'. Endpoint is https://employer.writersadmin.com/api/payments/handle-c2b-gateway-result.",
            ],
            [
                "name" => "Schemes of Work",
                "code" => "s",
                "endpoint" => "https://schemesofwork.com/api/payments/handle-c2b-gateway-result",
                "login_endpoint" => "https://schemesofwork.com/api/bots/login",
                "username" => "",
                "password" => "",
                "description" => "Schemes of work. Endpoint is https://schemesofwork.com/api/payments/handle-c2b-gateway-result.",
            ],
        ];


        foreach ($apps as $app) {
            App::create($app);
        }
    }
}
