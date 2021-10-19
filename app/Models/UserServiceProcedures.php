<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserServiceProcedures extends Model
{
  protected $table = "user_service_procedures";

  protected $primaryKey = "usp_id";

  protected $guarded = [];

  public $timestamps = true;

  public function config()
  {
    return $this->hasMany(Configdocumentlogistic::class, 'usp_config');
  }
}
