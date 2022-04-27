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
    use HasFactory;
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
        return $this->belongsTo(Media::class);
    }
    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}
