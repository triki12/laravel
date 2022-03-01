<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehicule extends Model
{
    protected $fillable = [
        'marque', 'modele', 'matricule'
    ];
}
