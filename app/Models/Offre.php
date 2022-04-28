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

    protected $fillable = ['entreprise_id', 'recruteur_id', 'contrat_id', 'poste',
        'description', 'salaire_min_annuel',
        'salaire_max_annuel', 'teletravail', 'lettre_motivation'];

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
