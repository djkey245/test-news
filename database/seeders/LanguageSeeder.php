<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['locale' => 'English', 'prefix' => 'en'],
            ['locale' => 'Ukrainian', 'prefix' => 'ua'],
            ['locale' => 'Polish', 'prefix' => 'pl']
        ];
        foreach ($languages as $language) {
            Language::firstOrCreate(['locale' => $language['locale'], 'prefix' => $language['prefix']]);
        }
    }
}
