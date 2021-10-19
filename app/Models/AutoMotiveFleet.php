<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoMotiveFleet extends Model
{
  protected $table = "auto_motive_fleets";

  protected $primaryKey = "amf_id";

  protected $guarded = [];

  public $timestamps = true;

  public function config()
  {
    return $this->hasMany(Configdocumentlogistic::class, "amf_config");
  }
}
