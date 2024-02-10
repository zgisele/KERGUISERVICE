<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'dateSoum',
        'etatCan',
        'user_id',
        'offre_emploi_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function offre_emplois()
    {
        return $this->belongsTo(OffreEmploi::class, 'offre_emploi_id');
    }
}
