<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingheavy extends Model
{
    protected $table = "settingheavys";
    protected $primaryKey = "heaId";
    protected $fillable = [
        'heaTypology','heaDisplacement','heaCapacity','heaDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
