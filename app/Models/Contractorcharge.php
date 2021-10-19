<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractorcharge extends Model
{
    protected $table = "contractorschargeexpress";
    protected $primaryKey = "ccId";
    protected $fillable = [
        'ccPhoto',
        'ccFirm',
        'ccNames',
        'ccPersonal_id',
        'ccNumberdocument',
        'ccDriving_id',
        'ccNumberdriving',
        'ccNeighborhood_id',
        'ccAddress',
        'ccBloodtype',
        'ccHealths_id',
        'ccRisk_id',
        'ccPension_id',
        'ccLayoff_id',
        'ccCompensation_id',
        'ccEmail',
        'ccMovil',
        'ccWhatsapp',
        'ccCourses',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CONTRATISTA PERTENECE A UNA CIUDAD/MUNICIPIO
    public function neighborhood(){
        return $this->belongsTo(Settingneighborhood::class,'ccNeighborhood_id');
    }
}
