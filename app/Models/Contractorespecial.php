<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractorespecial extends Model
{
  protected $table = "contractorsserviceespecial";

  protected $primaryKey = "ceId";

  protected $guarded = [];

  public $timestamps = true;

  // CADA CONTRATISTA PERTENECE A UNA CIUDAD/MUNICIPIO
  public function neighborhood()
  {
    return $this->belongsTo(Settingneighborhood::class, 'ceNeighborhood_id');
  }
}
