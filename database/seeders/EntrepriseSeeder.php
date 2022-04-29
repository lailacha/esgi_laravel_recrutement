<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Pays;
use App\Models\User;
use App\Models\Domaine;
use App\Services\MediaService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EntrepriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(MediaService $mediaService)
    {
        $faker = Factory::create('fr_FR');
        $pays = Pays::all();
        $domaines = Domaine::all();
        $entreprises = [];
        $entreprises[] = [
            'nom' => 'Société de test',
            'identification' => '12345678912345',
            'adresse' => '1 rue de test',
            'code_postal' => $faker->adresse()->zipCodeByState("FR"),
            'ville' => 'Paris',
            'pays_id' => $pays->random()->id,
            'domaine_id' => $domaines->random()->id,
            'description' => $faker->text(200),
            'logo_id' => $mediaService->saveRessourceGetInstance($request,'logo','logo')->id,
            'user_id' => User::all()->random()->id,
        ];

        DB::table('entreprises')->insert($entreprises);
    }
}
