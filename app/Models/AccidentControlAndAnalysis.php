<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccidentControlAndAnalysis extends Model
{
  protected $table = "accident_control_and_analyses";

  protected $primaryKey = "aca_id";

  protected $guarded = [];

  public $timestamps = true;

  public function config()
  {
    return $this->hasMany(Configdocumentlogistic::class, 'aca_config');
  }
}
