<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Briefcaseturismexpress extends Model
{
    protected $table = "briefcaseturismexpress";
    protected $primaryKey = "bteId";
    protected $fillable = [
        'bteYear',
        'bteMunicipility_id',
        'bteTypevehicle_id',
        'bteTypeservice_id',
        'bteValueratebase',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA PORTAFOLIO DE TURISMO TIENE UN TIPO DE SERVICIO
    public function service(){
        return $this->belongsTo(Settingserviceturism::class,'bteTypeservice_id');
    }

    // CADA PORTAFOLIO DE TURISMO TIENE UN TIPO DE VEHICULO DE ESPECIAL
    public function vehicle(){
        return $this->belongsTo(Settingespecial::class,'bteTypevehicle_id');
    }
}
