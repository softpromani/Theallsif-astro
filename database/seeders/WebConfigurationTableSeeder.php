<?php

namespace Database\Seeders;

use App\Models\WebConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Datas = [
            ['key' => 'facebook', 'value' => 'https://www.facebook.com/your-page', 'type' => 'social-media'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com/your-page', 'type' => 'social-media'],
            ['key' => 'twitter', 'value' => 'https://www.twitter.com/your-page', 'type' => 'social-media'],
            ['key' => 'youtube', 'value' => 'https://www.youtube.com/your-channel', 'type' => 'social-media'],
            ['key' => 'app_data', 'value' => 'https://astrology.com', 'type' => 'app'],
            // Add more key-value pairs as needed
        ];

        foreach ($Datas as $data) {
            WebConfiguration::create($data);
        }
    }
}
