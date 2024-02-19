<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;


    protected $fillable = [
        
        'appreciation',
        // 'user_id',
        'employeur_id',
        'candidat_id',
    ];


    public function candidat()
    {
        return $this->belongsTo(User::class, 'candidat_id');
    }

    public function employeur()
    {
        return $this->belongsTo(User::class, 'employeur_id');
    }


}
