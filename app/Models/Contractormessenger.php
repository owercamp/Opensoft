<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractormessenger extends Model
{
  protected $table = "contractorsmessenger";
  protected $primaryKey = "cmId";
  protected $guarded = [];
  public $timestamps = true;

  // CADA CONTRATISTA PERTENECE A UNA CIUDAD/MUNICIPIO
  public function neighborhood()
  {
    return $this->belongsTo(Settingneighborhood::class, 'cmNeighborhood_id');
  }
}
