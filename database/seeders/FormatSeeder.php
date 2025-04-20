<?php

namespace Database\Seeders;

use App\Models\Format;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    public function run(): void
    {
        $formats = ['Novel', 'Manga', 'Poetry', 'Graphic Novel', 'Non-fiction'];

        foreach ($formats as $name) {
            Format::create(['name' => $name]);
        }
    }
}

