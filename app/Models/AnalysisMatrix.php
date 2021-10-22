<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalysisMatrix extends Model
{
  protected $table = "analysis_matrices";

  protected $primaryKey = "am_id";

  protected $guarded = [];

  public $timestamps = true;

  public function document()
  {
    return $this->hasMany(Documentmanagerial::class, "amDoc");
  }
}
