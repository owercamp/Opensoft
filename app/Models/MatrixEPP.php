<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatrixEPP extends Model
{
  protected $table = "matrix_e_p_p_s";

  protected $primaryKey = "me_id";

  protected $guarded = [];

  public $timestamps = true;

  public function document()
  {
    return $this->hasMany(Documentmanagerial::class, "meDoc");
  }
}
