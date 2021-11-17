<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class interviewExpress extends Model
{
  protected $table = 'interview_expresses';

  protected $primaryKey = 'int_id';

  protected $guarded = [];

  public $timestamps = true;

  public function collaborator()
  {
    return $this->hasOne(Contractorcharge::class, 'int_IdCollaborator');
  }
}
