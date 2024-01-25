<?php

namespace App\Models;

use App\Models\Candidature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffreEmploi extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'typeContrat',
        'lieu',
        'description',
        'experienceMinimum',
        'slaireMinimum',
        'etat',
        'user_id',
        'profession_id',
    ];


    public function candidatures()
    {
        return $this->hasMany( Candidature::class);
    }
}
