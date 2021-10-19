<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requestcharge extends Model
{
    protected $table = "requestcharges";
    protected $primaryKey = "recId";
    protected $fillable = [
        'recTypecliente',
        'recClientpermanent_id',
        'recClientoccasional_id',
        'recCharge_id',
        'recDateservice',
        'recHourstart',
        'recAddressdestiny',
        'recMunicipalitydestiny_id',
        'recAddressorigin',
        'recMunicipalityorigin_id',
        'recContact',
        'recPhone',
        'recStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA REQUERIMIENTO DE CARGA TIENE UN CONTRATO PERMANENTE Opcional (LEGALIZACION CONTRAACTUAL)
    public function permanent(){
        return $this->belongsTo(Legalizationcontractual::class,'recClientpermanent_id');
    }

    // CADA REQUERIMIENTO DE CARGA TIENE UN CONTRATO OCASIONAL Opcional (ORDEN DE SERVICIO OCASIONAL)
    public function occasional(){
        return $this->belongsTo(Orderoccasional::class,'recClientoccasional_id');
    }

    // CADA REQUERIMIENTO DE CARGA TIENE UN SERVICIO DE CARGA EXPRESS
    public function charge(){
        return $this->belongsTo(Settingservicecharge::class,'recCharge_id');
    }

    // CADA REQUERIMIENTO DE CARGA TIENE UNA CIUDAD/MUNICIPIO DE DESTINO
    public function destiny(){
        return $this->belongsTo(Settingmunicipality::class,'recMunicipalitydestiny_id');
    }

    // CADA REQUERIMIENTO DE CARGA TIENE UNA CIUDAD/MUNICIPIO DE ORIGEN
    public function origin(){
        return $this->belongsTo(Settingmunicipality::class,'recMunicipalityorigin_id');
    }
}
