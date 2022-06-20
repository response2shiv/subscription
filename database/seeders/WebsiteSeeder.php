<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('websites')->insert([
            ['url' => 'https://inisev.com'],
            ['url' => 'https://facebook.com'],
            ['url' => 'https://google.com']
        ]);
    }
}
