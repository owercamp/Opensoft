<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requestlogistic extends Model
{
    protected $table = "requestlogistics";
    protected $primaryKey = "relId";
    protected $fillable = [
        'relTypecliente',
        'relClientpermanent_id',
        'relClientoccasional_id',
        'relLogistic_id',
        'relDateservice',
        'relHourstart',
        'relAddressdestiny',
        'relMunicipalitydestiny_id',
        'relAddressorigin',
        'relMunicipalityorigin_id',
        'relContact',
        'relPhone',
        'relStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA REQUERIMIENTO LOGISTICO TIENE UN CONTRATO PERMANENTE Opcional (LEGALIZACION CONTRAACTUAL)
    public function permanent(){
        return $this->belongsTo(Legalizationcontractual::class,'relClientpermanent_id');
    }

    // CADA REQUERIMIENTO LOGISTICO TIENE UN CONTRATO OCASIONAL Opcional (ORDEN DE SERVICIO OCASIONAL)
    public function occasional(){
        return $this->belongsTo(Orderoccasional::class,'relClientoccasional_id');
    }

    // CADA REQUERIMIENTO LOGISTICO TIENE UN SERVICIO DE LOGISTICA
    public function logistic(){
        return $this->belongsTo(Settingservicelogistic::class,'relLogistic_id');
    }

    // CADA REQUERIMIENTO LOGISTICO TIENE UNA CIUDAD/MUNICIPIO DE DESTINO
    public function destiny(){
        return $this->belongsTo(Settingmunicipality::class,'relMunicipalitydestiny_id');
    }

    // CADA REQUERIMIENTO LOGISTICO TIENE UNA CIUDAD/MUNICIPIO DE ORIGEN
    public function origin(){
        return $this->belongsTo(Settingmunicipality::class,'relMunicipalityorigin_id');
    }
}
