<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requestturism extends Model
{
    protected $table = "requestturisms";
    protected $primaryKey = "retId";
    protected $fillable = [
        'retTypecliente',
        'retClientpermanent_id',
        'retClientoccasional_id',
        'retTurism_id',
        'retDateservice',
        'retHourstart',
        'retAddressdestiny',
        'retMunicipalitydestiny_id',
        'retAddressorigin',
        'retMunicipalityorigin_id',
        'retContact',
        'retPhone',
        'retStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA REQUERIMIENTO DE TURISMO TIENE UN CONTRATO PERMANENTE Opcional (LEGALIZACION CONTRAACTUAL)
    public function permanent(){
        return $this->belongsTo(Legalizationcontractual::class,'retClientpermanent_id');
    }

    // CADA REQUERIMIENTO DE TURISMO TIENE UN CONTRATO OCASIONAL Opcional (ORDEN DE SERVICIO OCASIONAL)
    public function occasional(){
        return $this->belongsTo(Orderoccasional::class,'retClientoccasional_id');
    }

    // CADA REQUERIMIENTO DE TURISMO TIENE UN SERVICIO DE TURISMO
    public function turism(){
        return $this->belongsTo(Settingserviceturism::class,'retTurism_id');
    }

    // CADA REQUERIMIENTO DE TURISMO TIENE UNA CIUDAD/MUNICIPIO DE DESTINO
    public function destiny(){
        return $this->belongsTo(Settingmunicipality::class,'retMunicipalitydestiny_id');
    }

    // CADA REQUERIMIENTO DE TURISMO TIENE UNA CIUDAD/MUNICIPIO DE ORIGEN
    public function origin(){
        return $this->belongsTo(Settingmunicipality::class,'retMunicipalityorigin_id');
    }
}
