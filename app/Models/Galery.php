<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;
    
    protected $table = 'galery';


    public function classes()
    {
        return $this->hasMany(Classes::class, 'id', 'id_class');
    }

    public function photos()
    {
        return $this->hasMany(Photos::class, 'id_galeria', 'id');
    }
}
