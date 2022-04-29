<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Domaine;
use App\Models\Offre;
use App\Models\Media;
use App\Models\Pays;

class Entreprise extends Model
{
    protected $primaryKey = 'id';
    use HasFactory;

    protected $fillable = ['nom', 'description', 'domaine_id', 'pays_id', 'adresse', 'tel', 'mail','identification', 'media_id', 'code_postal', 'ville'];

    public function recruteurs()
    {
        return $this->hasMany(User::class);
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }

    public function logo()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}
