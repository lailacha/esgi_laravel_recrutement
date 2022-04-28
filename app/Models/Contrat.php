<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Offre;

class Contrat extends Model
{
    use HasFactory;
    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
}
