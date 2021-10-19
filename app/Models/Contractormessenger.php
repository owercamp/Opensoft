<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractormessenger extends Model
{
    protected $table = "contractorsmessenger";
    protected $primaryKey = "cmId";
    protected $fillable = [
        'cmPhoto',
        'cmFirm',
        'cmNames',
        'cmPersonal_id',
        'cmNumberdocument',
        'cmDriving_id',
        'cmNumberdriving',
        'cmNeighborhood_id',
        'cmAddress',
        'cmBloodtype',
        'cmHealths_id',
        'cmRisk_id',
        'cmPension_id',
        'cmLayoff_id',
        'cmCompensation_id',
        'cmEmail',
        'cmMovil',
        'cmWhatsapp',
        'cmCourses',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA CONTRATISTA PERTENECE A UNA CIUDAD/MUNICIPIO
    public function neighborhood(){
        return $this->belongsTo(Settingneighborhood::class,'cmNeighborhood_id');
    }
}
