<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abouts')->insert(
            [
                [
                    "name" => "Salem",
                    "phone" => "+967779011984",
                    "email" => "smoaa667@gmail.com",
                    "address" => "Hadramout",
                    "description" => "Fullstack Web Developer with Laravel and Vue Js",
                    "summary" => "Good experience in web development",
                    "tagline" => "Fullstack Web Developer",
                    "cv" => "salem.pdf",
                ]
            ]
                );
    }
}
