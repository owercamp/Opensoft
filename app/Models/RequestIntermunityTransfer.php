<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestIntermunityTransfer extends Model
{
  protected $table = "request_intermunity_transfers";
  protected $primaryKey = "reiId";
  protected $fillable = [
    'reiTypecliente',
    'reiClientpermanent_id',
    'reiClientoccasional_id',
    'reiTransfer_id',
    'reiDateservice',
    'reiHourstart',
    'reiAddressdestiny',
    'reiMunicipalitydestiny_id',
    'reiAddressorigin',
    'reiMunicipalityorigin_id',
    'reiContact',
    'reiPhone',
    'reiStatus',
    'created_at',
    'updated_at'
  ];
  public $timestamps = true;

  // CADA REQUERIMIENTO DE TURISMO TIENE UN CONTRATO PERMANENTE Opcional (LEGALIZACION CONTRAACTUAL)
  public function permanent()
  {
    return $this->belongsTo(Legalizationcontractual::class, 'reiClientpermanent_id');
  }

  // CADA REQUERIMIENTO DE TURISMO TIENE UN CONTRATO OCASIONAL Opcional (ORDEN DE SERVICIO OCASIONAL)
  public function occasional()
  {
    return $this->belongsTo(Orderoccasional::class, 'reiClientoccasional_id');
  }

  // CADA REQUERIMIENTO DE TRASLADO TIENE UN SERVICIO DE TRASLADO
  public function transfer()
  {
    return $this->belongsTo(Settingservicetransfermunicipal::class, 'reiTransfer_id');
  }

  // CADA REQUERIMIENTO DE TURISMO TIENE UNA CIUDAD/MUNICIPIO DE DESTINO
  public function destiny()
  {
    return $this->belongsTo(Settingmunicipality::class, 'reiMunicipalitydestiny_id');
  }

  // CADA REQUERIMIENTO DE TURISMO TIENE UNA CIUDAD/MUNICIPIO DE ORIGEN
  public function origin()
  {
    return $this->belongsTo(Settingmunicipality::class, 'reiMunicipalityorigin_id');
  }
}
