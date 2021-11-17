<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class interviewSpecial extends Model
{
  protected $table = 'interview_specials';

  protected $primaryKey = 'int_id';

  protected $guarded = [];

  public $timestamps = true;

  public function collaborator()
  {
    return $this->hasOne(Contractorespecial::class, 'int_IdCollaborator');
  }
}
