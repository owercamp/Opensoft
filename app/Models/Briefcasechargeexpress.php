<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Briefcasechargeexpress extends Model
{
    protected $table = "briefcasechargeexpress";
    protected $primaryKey = "bceId";
    protected $fillable = [
        'bceYear',
        'bceMunicipility_id',
        'bceTypevehicle_id',
        'bceTypeservice_id',
        'bceValueratebase',
        'bceValuekilometres',
        'bceValuereturn',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA PORTAFOLIO DE CARGA EXPRESS TIENE UN TIPO DE SERVICIO
    public function service(){
        return $this->belongsTo(Settingservicecharge::class,'bceTypeservice_id');
    }

    // CADA PORTAFOLIO DE CARGA EXPRESS TIENE UN TIPO DE VEHICULO DE CARGA
    public function vehicle(){
        return $this->belongsTo(Settingheavy::class,'bceTypevehicle_id');
    }
}
