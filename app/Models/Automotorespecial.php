<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Automotorespecial extends Model
{
    protected $table = "automotorsespecial";
    protected $primaryKey = "aueId";
    protected $fillable = [
        'auePhone',
        'aueTypevehicle_id',
        'auePlate',
        'aueBrand',
        'aueModel',
        'aueAlliesespecial_id',
        'aueContractorespecial_id',
        'aueContractorespecials',
        'auePhotofront',
        'auePhotoside',
        'auePhotoback',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
