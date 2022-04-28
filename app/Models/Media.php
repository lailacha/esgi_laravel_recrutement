<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Candidature;
use App\Models\Entreprise;
use App\Models\User;

class Media extends Model
{
    protected $fillable = ['chemin', 'extension', 'taille_en_ko', 'nom', 'created_at', 'updated_at'];

    use HasFactory;

    public function cvCandidature()
    {
        return $this->hasMany(Candidature::class, 'cv_id');
    }

    public function lettreMotivationCandidature()
    {
        return $this->hasMany(Candidature::class, 'lettre_motivation_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function cvUser()
    {
        return $this->belongsTo(User::class, 'cv_id');
    }

    public function avatarUser()
    {
        return $this->belongsTo(User::class, 'avatar_id');
    }
}
