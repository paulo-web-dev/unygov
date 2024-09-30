<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    
    
    use HasFactory;

    protected $table = 'photos';

   
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    
    public function classes()
    {
        return $this->hasMany(Classes::class, 'id', 'id_class');
    }

}
