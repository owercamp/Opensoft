<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidirectionalCommunicationSystem extends Model
{
  protected $table = "bidirectional_communication_systems";

  protected $primaryKey = "bcs_id";

  protected $guarded = [];

  public $timestamps = true;

  public function config()
  {
    return $this->hasMany(Configdocumentlogistic::class, "bcs_config");
  }
}
