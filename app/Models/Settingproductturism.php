<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingproductturism extends Model
{
    protected $table = "settingproductsturism";
    protected $primaryKey = "ptId";
    protected $fillable = [
        'ptProduct','ptAvailability','ptDescription','created_at','updated_at'
    ];
    public $timestamps = true;
}
