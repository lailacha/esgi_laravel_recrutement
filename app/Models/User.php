<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Entreprise;
use App\Models\Offre;
use App\Models\Candidature;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'avatar_id',
        'cv_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function offres()
    {
        return $this->hasMany(Offre::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'candidat_id');
    }

    public function avatar()
    {
        return $this->belongsTo(Media::class, 'avatar_id');
    }

    public function cv()
    {
        return $this->belongsTo(Media::class, 'cv_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isRecruteur()
    {
        return $this->hasRole('recruteur');
    }

    public function isCandidat()
    {
        return $this->hasRole('candidat');
    }
}
