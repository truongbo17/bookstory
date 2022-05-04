<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nguyen Quang Truong',
            'email' => 'truongnq017@gmail.com',
            'password' => Hash::make('12345678'),
            'is_admin' => 1
        ]);

        DB::table('urls')->insert([
            'site' => 'https://www.scirp.org',
            'url_start' => 'https://www.scirp.org/journal/journalarticles.aspx?journalid=2436',
            'should_crawl' => '/^https:\/\/www\.scirp\.org\/journal/',
            'should_get_data' => '/^https:\/\/www\.scirp\.org\/journal\/paperinformation.aspx\?paperid=/',
            'should_get_info' => '{
                "title":"text|title",
                "content":"text|#JournalInfor_div_paper > div:nth-child(3) > p:nth-child(2)",
                "download_link":"href|span#JournalInfor_showDOI ~ a",
                "keywords":"array|div#JournalInfor_div_showkeywords a",
                "authors":"array|div#JournalInfor_div_paper > div:nth-child(2) > a"
                }',
            'config_root_url' => 1,
            'status' => 0,
            'driver_browser' => 'guzzle',
        ]);
    }
}
