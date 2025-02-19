<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class annonce extends Model
{
    use HasFactory;
    private $titre;
    protected $fillable=[
        'titre',
        'description',
        'lieu',
        'date_trouv_perte',
        'image',
        'email',
        'phone',
        'status'
    ]; 
}
