<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Entreprise;
use App\Models\Contrat;

class Offre extends Model
{
    use HasFactory;

    public function recruteur()
    {
        return $this->belongsTo(User::class, 'recruteur_id');
    }
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}
