<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class interviewCollaborator extends Model
{
  protected $table = 'interview_collaborators';

  protected $primaryKey = 'int_id';

  protected $guarded = [];

  public $timestamps = true;

  public function collaborator()
  {
    return $this->hasOne(Collaborator::class, 'int_IdCollaborator');
  }
}
