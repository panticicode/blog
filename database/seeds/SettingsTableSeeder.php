<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting :: create([
        	'site_name' => 'Laravel\'s blog',
        	'address' => 'Australia, Melburne',
        	'contact_number' => '8 900 7568 3324',
        	'contact_email' => 'info@laravel_blog.com'
        ]);
    }
}
