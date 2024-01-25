<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Evaluation;
use App\Models\Candidature;
use App\Models\OffreEmploi;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'imageDeProfil',
        'email',
        // 'motDePasse',
        'password',
        'telephone',
        'presentation',
        'langueParler',
        'civilite',
        'experienceProf',
        'dateNaissance',
        'lieu',
        'statut',
        'role',
        'profession_id',
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

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
    public function offre_emplois()
    {
        return $this->hasMany(OffreEmploi::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function getJWTIdentifier()
    // {
    //   return $this->getKey();
    // }

    // public function getJWTCustomClaims()
    // {
    //   return [];
    // }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    
}
