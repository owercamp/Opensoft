<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreventiveMaintenanceReview extends Model
{
  protected $table = "preventive_maintenance_reviews";

  protected $primaryKey = "pmr_id";

  protected $guarded = [];

  public $timestamps = true;

  public function config()
  {
    return $this->hasMany(Configdocumentlogistic::class, "pmr_config");
  }
}
