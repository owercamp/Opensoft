<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requestmessenger extends Model
{
    protected $table = "requestmessengers";
    protected $primaryKey = "remId";
    protected $fillable = [
        'remTypecliente',
        'remClientpermanent_id',
        'remClientoccasional_id',
        'remMessenger_id',
        'remDateservice',
        'remHourstart',
        'remAddressdestiny',
        'remMunicipalitydestiny_id',
        'remAddressorigin',
        'remMunicipalityorigin_id',
        'remContact',
        'remPhone',
        'remObservation',
        'remStatus',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    // CADA REQUERIMIENTO DE MENSAJERIA TIENE UN CONTRATO PERMANENTE Opcional (LEGALIZACION CONTRAACTUAL)
    public function permanent(){
        return $this->belongsTo(Legalizationcontractual::class,'remClientpermanent_id');
    }

    // CADA REQUERIMIENTO DE MENSAJERIA TIENE UN CONTRATO OCASIONAL Opcional (ORDEN DE SERVICIO OCASIONAL)
    public function occasional(){
        return $this->belongsTo(Orderoccasional::class,'remClientoccasional_id');
    }

    // CADA REQUERIMIENTO DE MENSAJERIA TIENE UN SERVICIO DE MENSAJERIA
    public function messenger(){
        return $this->belongsTo(Settingservicemessenger::class,'remMessenger_id');
    }

    // CADA REQUERIMIENTO DE MENSAJERIA TIENE UNA CIUDAD/MUNICIPIO DE DESTINO
    public function destiny(){
        return $this->belongsTo(Settingmunicipality::class,'remMunicipalitydestiny_id');
    }

    // CADA REQUERIMIENTO DE MENSAJERIA TIENE UNA CIUDAD/MUNICIPIO DE ORIGEN
    public function origin(){
        return $this->belongsTo(Settingmunicipality::class,'remMunicipalityorigin_id');
    }
}
