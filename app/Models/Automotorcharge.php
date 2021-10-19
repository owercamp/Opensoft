<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automotorcharge extends Model
{
    protected $table = "automotorscharge";
    protected $primaryKey = "aucId";
    protected $fillable = [
        'aucPhone',
        'aucTypevehicle_id',
        'aucPlate',
        'aucBrand',
        'aucModel',
        'aucContractormessenger_id',
        'aucContractormessengers',
        'aucPhotofront',
        'aucPhotoside',
        'aucPhotoback',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
