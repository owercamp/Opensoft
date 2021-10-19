<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficRegulationsViolation extends Model
{
  protected $table = "traffic_regulations_violations";

  protected $primaryKey = "trv_id";

  protected $guarded = [];

  public function Config()
  {
    return $this->hasMany(Configdocumentlogistic::class, "trv_config");
  }
}
