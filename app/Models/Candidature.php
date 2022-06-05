<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offre;
use App\Models\Media;
use App\Models\User;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = ['candidat_id', 'offre_id', 'cv_id', 'lettre_motivation_id',];

    public function cv()
    {
        return $this->belongsTo(Media::class);
    }
    public function lettreMotivation() // à voir avec gael si snake case ou pas
    {
        return $this->belongsTo(Media::class);
    }
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }
}
