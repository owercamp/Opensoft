<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferencesCollaborator extends Model
{
    protected $table = 'references_collaborators';

    protected $primaryKey = 'rc_id';

    protected $guarded = [];

    public $timestamps = true;

    public function collaborator()
    {
      // !relacion con la tabla de collaborator
      return $this->belongsTo(Collaborator::class, 'rc_collaborator_id');
    }
}
