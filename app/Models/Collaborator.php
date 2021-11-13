<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
  protected $table = "collaborators";
  protected $primaryKey = "coId";
  protected $guarded = [];
  public $timestamps = true;

  // CADA COLABORADOR TIENE UN TIPO DE DOCUMENTO
  public function type()
  {
    return $this->belongsTo(Settingpersonal::class, 'coPersonal_id');
  }
}
