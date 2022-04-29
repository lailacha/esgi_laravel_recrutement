<?php

namespace App\Services;

use App\Models\User;
use App\Models\Media;
use App\Helpers\FileHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

/**
 * Class MediaService.
 */
class MediaService
{
    /**
     * saveRessourceGetInstance
     * Permet d'enregistrer une ressource dans la base de données puis de récuperer l'instance Media
     *  afin de l'enregistrer comme dépendance dans un autre objet.
     * @param  mixed $request
     * @param  mixed $mediaType
     * @param  mixed $directory
     * @param  mixed $disk
     * @return Media
     */
    public function saveRessourceGetInstance(Request $request, string $mediaType, string $directory, string $disk = "public")
    {
        $user_id = count(User::all()) + 1;
        $mediaName = $user_id."_".$mediaType."_".Str::random(20);
        $file = $request->file($mediaType);

        $file->storeAs($directory, $mediaName.'.' . $file ->getClientOriginalExtension(), $disk);

        $media = Media::create([
            'chemin' =>  $mediaName.'.' . $file ->getClientOriginalExtension(),
            'nom' =>  $mediaName,
            "extension" => $file->getClientOriginalExtension(),
            'taille_en_ko' => FileHelper::convertByteToKo($file->getSize()),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $media;
    }
}
