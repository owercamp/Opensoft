<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractorespecial extends Model
{
    protected $table = "contractorsserviceespecial";
    protected $primaryKey = "ceId";
    protected $fillable = [
        'cePhoto',
        'ceFirm',
        'ceNames',
        'cePersonal_id',
        'ceNumberdocument',
        'ceDriving_id',
        'ceNumberdriving',
        'ceNeighborhood_id',
        'ceAddress',
        'ceBloodtype',
        'ceHealths_id',
        'ceRisk_id',
        'cePension_id',
        'ceLayoff_id',
        'ceCompensation_id',
        'ceEmail',
        'ceMovil',
        'ceWhatsapp',
        'ceCourses',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CONTRATISTA PERTENECE A UNA CIUDAD/MUNICIPIO
    public function neighborhood(){
        return $this->belongsTo(Settingneighborhood::class,'ceNeighborhood_id');
    }
}
