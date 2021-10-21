<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalParent extends Model
{
  protected $table = "legal_parents";

  protected $primaryKey = "lp_id";

  protected $guarded = [];

  public $timestamps = true;

  public function collaborator()
  {
    return $this->hasMany(Collaborator::class, "lp_collaborator");
  }

  public function document()
  {
    return $this->hasMany(Documentmanagerial::class, "lp_fDoc");
  }
}
