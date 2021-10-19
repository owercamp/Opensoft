<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
  protected $table = "procedures";

  protected $primaryKey = "pro_id";

  protected $guarded = [];

  public $timestamps = true;

  public function ConfigDoc()
  {
    return $this->hasMany(Configdocumentmanagerial::class, "domId");
  }
}
