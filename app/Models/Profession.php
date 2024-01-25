<?php

namespace App\Models;

use App\Models\OffreEmploi;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profession extends Model
{
    use HasFactory;


    protected $fillable = [
        'nom_prof',
        'description',
    ];



    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function offre_emplois()
    {
        return $this->hasMany(OffreEmploi::class);
    }
}
