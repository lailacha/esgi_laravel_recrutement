<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;
    public function cv()
    {
        return $this->belongsTo(Media::class);
    }
    public function lettreMotivation() // à voir avec gael si snake case ou pas
    {
        return $this->belongsTo(Media::class);
    }
}
