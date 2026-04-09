<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'alamat' => 'Jalan Pahlawan Nomer 3',
                'maps_embed' => '<iframe src="https://www.google.com/maps/embed?..."></iframe>',
                'whatsapp' => '089685259671',
            ]
        );
    }
}
