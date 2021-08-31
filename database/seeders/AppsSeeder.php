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
                "endpoint" => "http://employer.writersadmin.com/api/payments/handle-c2b-gateway-result",
                "description" => "Writers Admin employers app has the 'e' representing 'employers'. Endpoint is http://employer.writersadmin.com/api/payments/handle-c2b-gateway-result.",
            ],
            [
                "name" => "Writers Admin Writers",
                "code" => "ww",
                "endpoint" => "http://employer.writersadmin.com/api/payments/handle-c2b-gateway-result",
                "description" => "Writers Admin writers app has the 'w' representing 'writers'. Endpoint is http://employer.writersadmin.com/api/payments/handle-c2b-gateway-result.",
            ],
            [
                "name" => "Schemes of Work",
                "code" => "s",
                "endpoint" => "http://schemesofwork.com/api/payments/handle-c2b-gateway-result",
                "description" => "Schemes of work. Endpoint is http://schemesofwork.com/api/payments/handle-c2b-gateway-result.",
            ],
        ];


        foreach ($apps as $app) {
            App::create($app);
        }
    }
}
