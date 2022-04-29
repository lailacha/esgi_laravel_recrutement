<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Media;



class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::create([
            'nom' => 'default_logo',
            'chemin' => 'default_logo.png',
            'extension' => 'png',
            'taille_en_ko' => '1024',
        ]);
    }
}
