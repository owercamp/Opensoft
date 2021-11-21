<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferencesExpress extends Model
{
  protected $table = 'references_expresses';

  protected $primaryKey = 'rc_id';

  protected $guarded = [];

  public $timestamps = true;

  public function collaborator()
  {
    // !relacion con la tabla de contractorschargeexpress
    return $this->belongsTo(Contractorcharge::class, 'rc_collaborator_id');
  }
}
