<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractorcharge extends Model
{
  protected $table = "contractorschargeexpress";
  protected $primaryKey = "ccId";
  protected $guarded = [];
  public $timestamps = true;

  // CADA CONTRATISTA PERTENECE A UNA CIUDAD/MUNICIPIO
  public function neighborhood()
  {
    return $this->belongsTo(Settingneighborhood::class, 'ccNeighborhood_id');
  }
}
