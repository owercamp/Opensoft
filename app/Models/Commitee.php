<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commitee extends Model
{
  protected $table = "commitees";

  protected $primaryKey = "comid";

  protected $guarded = [];

  public $timestamps = true;

  public function document()
  {
    return $this->hasOne(Configdocumentmanagerial::class, 'comconf');
  }
}
