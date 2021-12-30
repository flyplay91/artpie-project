<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::truncate();

        $settings =  [
            [
              'key' => 'sell_price_percentage',
              'value' => '120'
            ]
        ];

        Settings::insert($settings);

    }
}
