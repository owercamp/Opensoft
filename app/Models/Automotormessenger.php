<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automotormessenger extends Model
{
    protected $table = "automotorsmessenger";
    protected $primaryKey = "aumId";
    protected $fillable = [
        'aumPhone',
        'aumMotorcycle_id',
        'aumPlate',
        'aumBrand',
        'aumModel',
        'aumContractormessenger_id',
        'aumContractormessengers',
        'aumPhotofront',
        'aumPhotoside',
        'aumPhotoback',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
