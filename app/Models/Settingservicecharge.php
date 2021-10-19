<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settingservicecharge extends Model
{
    protected $table = "settingservicescharge";
    protected $primaryKey = "scId";
    protected $fillable = [
        'scTypeproduct_id',
        'scService',
        'scUnit',
        'scKilos',
        'scDimensions',
        'scDescription',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
