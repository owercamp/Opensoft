<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliationcollaborator extends Model
{
    protected $table = "affiliationcollaborators";
    protected $primaryKey = "afcId";
    protected $fillable = [
        'afcLegalization_id',
        'afcHealth_id',
        'afcPension_id',
        'afcLayoff_id',
        'afcRisk_id',
        'afcCompensation_id',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA AFILIACION TIENE UNA LEGALIZACION
    public function bill(){
        return $this->belongsTo(Billcollaborator::class,'afcLegalization_id');
    }

    // CADA AFILIACION TIENE UNA AFILIACION A SALUD
    public function health(){
        return $this->belongsTo(Settinghealth::class,'afcHealth_id');
    }

    // CADA AFILIACION TIENE UNA AFILIACION A PENSION
    public function pension(){
        return $this->belongsTo(Settingpension::class,'afcPension_id');
    }

    // CADA AFILIACION TIENE UNA AFILIACION A CESANTIAS
    public function layoff(){
        return $this->belongsTo(Settinglayoff::class,'afcLayoff_id');
    }

    // CADA AFILIACION TIENE UNA AFILIACION A CESANTIAS
    public function risk(){
        return $this->belongsTo(Settingrisk::class,'afcRisk_id');
    }

    // CADA AFILIACION TIENE UNA AFILIACION A CESANTIAS
    public function compensation(){
        return $this->belongsTo(Settingcompensation::class,'afcCompensation_id');
    }
}
