<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annonce extends Model
{
    use HasFactory;
    private $titre;
    protected $fillable = [
        'titre',
        'description',
        'lieu',
        'photo', 
        'email',
        'tele',
        'status',
        'categorie_id',
        'user_id'
    ];
    
}
