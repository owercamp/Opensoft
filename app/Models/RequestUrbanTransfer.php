<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestUrbanTransfer extends Model
{
  protected $table = "request_urban_transfers";
  protected $primaryKey = "reuId";
  protected $fillable = [
    'reuTypecliente',
    'reuClientpermanent_id',
    'reuClientoccasional_id',
    'reuTransfer_id',
    'reuDateservice',
    'reuHourstart',
    'reuAddressdestiny',
    'reuMunicipalitydestiny_id',
    'reuAddressorigin',
    'reuMunicipalityorigin_id',
    'reuContact',
    'reuPhone',
    'reuStatus',
    'created_at',
    'updated_at'
  ];
  public $timestamps = true;

  // CADA REQUERIMIENTO DE TURISMO TIENE UN CONTRATO PERMANENTE Opcional (LEGALIZACION CONTRAACTUAL)
  public function permanent()
  {
    return $this->belongsTo(Legalizationcontractual::class, 'reuClientpermanent_id');
  }

  // CADA REQUERIMIENTO DE TURISMO TIENE UN CONTRATO OCASIONAL Opcional (ORDEN DE SERVICIO OCASIONAL)
  public function occasional()
  {
    return $this->belongsTo(Orderoccasional::class, 'reuClientoccasional_id');
  }

  // CADA REQUERIMIENTO DE TRASLADO TIENE UN SERVICIO DE TRASLADO
  public function transfer()
  {
    return $this->belongsTo(Settingservicetransfer::class, 'reuTransfer_id');
  }

  // CADA REQUERIMIENTO DE TURISMO TIENE UNA CIUDAD/MUNICIPIO DE DESTINO
  public function destiny()
  {
    return $this->belongsTo(Settingmunicipality::class, 'reuMunicipalitydestiny_id');
  }

  // CADA REQUERIMIENTO DE TURISMO TIENE UNA CIUDAD/MUNICIPIO DE ORIGEN
  public function origin()
  {
    return $this->belongsTo(Settingmunicipality::class, 'reuMunicipalityorigin_id');
  }
}
