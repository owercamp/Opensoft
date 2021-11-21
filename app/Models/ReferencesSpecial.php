<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferencesSpecial extends Model
{
  protected $table = 'references_specials';

  protected $primaryKey = 'rc_id';

  protected $guarded = [];

  public $timestamps = true;

  public function collaborator()
  {
    // !relacion con la tabla de contractorsserviceespecial
    return $this->belongsTo(Contractorespecial::class, 'rc_collaborator_id');
  }
}
